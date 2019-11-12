<?php

namespace App\Http\Controllers;

use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use OhMyBrew\ShopifyApp\Jobs\ScripttagInstaller;
use OhMyBrew\ShopifyApp\Jobs\WebhookInstaller;
use App\ShopOwner;
use App\Shop;
use Event;
use App\Events\InstallEvent;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Traits\AuthControllerTrait;
class AuthController extends Controller
{
    use AuthControllerTrait;

    protected function authenticationWithoutCode()
    {
        $shopDomain = session('shopify_domain');
        $api = ShopifyApp::api();
        $api->setShop($shopDomain);

        // Grab the authentication URL
        $authUrl = $api->getAuthUrl(
            config('shopify-app.api_scopes'),
            url(config('shopify-app.api_redirect'))
        );

        $scope = urlencode(config('shopify-app.api_scopes'));
        $api_redirect = urlencode(url(config('shopify-app.api_redirect')));
        $new_api_redirect = (!strpos(url(config('shopify-app.api_redirect')), "s:")) ? urlencode(substr_replace(url(config('shopify-app.api_redirect')), "s", 4, 0)) : $api_redirect;
        $key = config('shopify-app.api_key');
        // Do a fullpage redirect
        return view('auth.fullpage_redirect', [
            'scope' => $scope,
            'key' => $key,
            'api_redirect' => $new_api_redirect,
            'authUrl'    => $authUrl,
            'shopDomain' => $shopDomain,
        ]);
    }
    protected function authenticationWithCode()
    {
        $shopDomain = session('shopify_domain');
        $api = ShopifyApp::api();
        $api->setShop($shopDomain);

        // Check if request is verified
        if (!$api->verifyRequest(request()->all())) {
            // Not valid, redirect to login and show the errors
            return redirect()->route('login')->with('error', trans('label.Invalid_signature'));
        }
      
        // Save token to shop
        $shop = ShopifyApp::shop();
        $shop->shopify_token = $api->requestAccessToken(request('code'));
        $shop->save();
        $id_shop = $shop->id;
        // Install webhooks and scripttags
        $this->installWebhooks();
        $this->installScripttags();

        // Run after authenticate job
        $this->afterAuthenticateJob();
        $shop = ShopifyApp::shop();
        $request = $shop->api()->request('GET', '/admin/shop.json');
        $shop_owner_info = ShopOwner::getShopOwnerByDomain($request->body->shop->email);
        $id_shop_owner = !empty($shop_owner_info) ? $shop_owner_info->id : $this->updateShop($request->body->shop);
        $id_shop_owner ? $this->updateShopOwner($id_shop, $id_shop_owner) : '';
        // Go to homepage of app
        Event::fire(new InstallEvent($shopDomain,trans('label.email_install_title'), 'install'));
        return redirect()->route('setting.create', $request->body->shop->domain);
    }

     /**
     * @param  object $shop
     * @return  int
     */
    private function updateShop($shop){
        $shop_owner = new ShopOwner();
        $shop_owner->email = $shop->email;
        $shop_owner->name = $shop->name;
        $shop_owner->phone = $shop->phone;
        $shop_owner->address = $shop->address1;
        $shop_owner->save();
        return $shop_owner->id;
    }

    /**
     * @param  int $id_shop
     * @param  int $id_shop_owner
     * @return boolean         
     */
    private function updateShopOwner($id_shop, $id_shop_owner){
        $shop = Shop::find($id_shop);
        $shop->id_shop_owner = $id_shop_owner;
        $shop->active = 1;
        $shop->save();
    }

    public function uninstall(Request $request) {
        $shopDomain = request()->header('x-shopify-shop-domain');
        Event::fire(new InstallEvent($shopDomain,trans('label.email_uninstall_title'), 'uninstall'));
        $shop_info = Shop::getInfoByDomain($shopDomain);
        $shop = $shop_info ?  Shop::find($shop_info->id) : null;
        if($shop) {
            $shop->active = 0;
            $shop->save();
        }
    }
}
