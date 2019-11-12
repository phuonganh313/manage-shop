<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Setting;
use File;
use Event;
use App\Events\InstallEvent;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;

class SettingController extends Controller
{
    private $setting;
    private $shop;

    public static $settings_folder = './settings/';
    public static $sounds_folder = '/public/sounds/';

    public function __construct(){
        $this->setting = new Setting();
        $this->shop = new Shop();
    }

    /**
     * Show the form for creating a new resource.
     * @param string $domain
     * @return \Illuminate\Http\Response
     */
    public function create($domain) {
        $shop_info = Shop::getInfoByDomain($domain);
        if ($shop_info) {
            return view('default.store')->with('data', array(
                'shop_setting' => Shop::getSettingsByDomain($domain),
                'settings'     => array(
                    'font_family'    => $this->setting->ca_font_family,
                    'font_style'     => $this->setting->ca_font_style,
                    'position'       => $this->setting->ca_position,
                    'animation'      => $this->setting->ca_animation,
                    'shape'          => $this->setting->ca_shape,
                    'flicker_timing' => $this->setting->ca_flicker_timing,
                    'sound_effect'   => $this->setting->ca_sound_effect,
                    'repeat'         => $this->setting->ca_repeat,
                    'frequency'      => $this->setting->ca_frequency,
                )
            ));
        } else {
            echo trans('label.shop_not_found');die;
        }
    }

    /**
     * @param  Request $request
     * @param string $domain
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $domain) {
        $input = $request->all();
        $msg = trans('label.upd_err');
        $shop_info = Shop::getInfoByDomain($domain);
        $shop = $shop_info ? Shop::find($shop_info->id) : null;
        $result = false;
        if ($shop) {
            if ($shop->setting) {
                $result = $shop->setting->update($input);
            } else {
                $setting = new Setting($input);
                $result = $shop->setting()->save($setting);
            }
        }
        if ($result) {
            $msg = trans('label.updated');
            file_put_contents(self::$settings_folder.$domain.'.json', json_encode($input));
        }
        
        return redirect()->back()->with('alert', $msg );    
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSettingsByDomain(Request $request) {
        return response()->json(Shop::getSettingsByDomain($request->domain));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFileSettingsByDomain(Request $request) {
        $path = url(self::$settings_folder); 
        $sound_path = url(self::$sounds_folder); 
        $shop = Shop::getSettingsByDomain($request->domain);
        $sound_content = $shop->sound_effect !== 'off' ? $sound_path.'/'.$shop->sound_effect : null;
        $silent = $sound_path.'/silent.wav';
        return response()->json(array(
            'file'   => json_decode(File::exists(self::$settings_folder.$request->domain.'.json') ? file_get_contents($path.'/'.$request->domain.'.json') : file_get_contents($path.'/default.json')),
            'sound'  => $sound_content,
            'silent' => $silent
        ));
    }

    public function uninstall() {
        $shopDomain = request()->header('x-shopify-shop-domain');
        $shop_info = Shop::getInfoByDomain($shopDomain);
        $shop = $shop_info ? new Shop($shop_info->id) : null;
        if($shop) {
            $shop->update(['active'=> 0]);
        }
        Event::fire(new InstallEvent($shopDomain,'test'));
    }

}