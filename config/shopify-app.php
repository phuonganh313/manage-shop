<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shop Model
    |--------------------------------------------------------------------------
    |
    | This option is for overriding the shop model with your own.
    |
    */

    'shop_model' => env('SHOPIFY_SHOP_MODEL', '\OhMyBrew\ShopifyApp\Models\Shop'),

    /*
    |--------------------------------------------------------------------------
    | ESDK Mode
    |--------------------------------------------------------------------------
    |
    | ESDK (embedded apps) are enabled by default. Set to false to use legacy
    | mode and host the app inside your own container.
    |
    */

    'esdk_enabled' => (bool) env('SHOPIFY_ESDK_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Shopify App Name
    |--------------------------------------------------------------------------
    |
    | This option simply lets you display your app's name.
    |
    */

    'app_name' => env('SHOPIFY_APP_NAME', 'Cart alerts'),

    /*
    |--------------------------------------------------------------------------
    | Shopify API Key
    |--------------------------------------------------------------------------
    |
    | This option is for the app's API key.
    |
    */

    'api_key' => env('SHOPIFY_API_KEY', '1d267e165bfc80a2de9af4a610fea107'),

    /*
    |--------------------------------------------------------------------------
    | Shopify API Secret
    |--------------------------------------------------------------------------
    |
    | This option is for the app's API secret.
    |
    */

    'api_secret' => env('SHOPIFY_API_SECRET', 'f2c8f2f60eba5eae4b12894f459ca658'),

    /*
    |--------------------------------------------------------------------------
    | Shopify API Scopes
    |--------------------------------------------------------------------------
    |
    | This option is for the scopes your application needs in the API.
    |
    */

    'api_scopes' => env('SHOPIFY_API_SCOPES', 'read_themes,write_themes,read_script_tags,write_script_tags'),

    /*
    |--------------------------------------------------------------------------
    | Shopify API Redirect
    |--------------------------------------------------------------------------
    |
    | This option is for the redirect after authentication.
    |
    */

    'api_redirect' => env('SHOPIFY_API_REDIRECT', '/authenticate'),

    /*
    |--------------------------------------------------------------------------
    | Shopify API class
    |--------------------------------------------------------------------------
    |
    | This option option allows you to change out the default API class
    | which is OhMyBrew\BasicShopifyAPI. This option is mainly used for
    | testing and does not need to be changed unless required.
    |
    */

    'api_class' => env('SHOPIFY_API_CLASS', \OhMyBrew\BasicShopifyAPI::class),

    /*
    |--------------------------------------------------------------------------
    | Shopify "MyShopify" domain
    |--------------------------------------------------------------------------
    |
    | The internal URL used by shops. This will not change but in the future
    | it may.
    |
    */

    'myshopify_domain' => 'cartalerts.hamsa.site/login',

    /*
    |--------------------------------------------------------------------------
    | Enable Billing
    |--------------------------------------------------------------------------
    |
    | Enable billing component to the package.
    |
    */

    'billing_enabled' => (bool) env('SHOPIFY_BILLING_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Billing Type
    |--------------------------------------------------------------------------
    |
    | Single charge or recurring charge.
    | Simply use "single" for single, and "recurring" for recurring.
    |
    */

    'billing_type' => env('SHOPIFY_BILLING_TYPE', 'recurring'),

    /*
    |--------------------------------------------------------------------------
    | Billing Plan Name
    |--------------------------------------------------------------------------
    |
    | The name of the plan which shows on the billing.
    |
    */

    'billing_plan' => env('SHOPIFY_BILLING_PLAN_NAME', 'Base Plan'),

    /*
    |--------------------------------------------------------------------------
    | Billing Price
    |--------------------------------------------------------------------------
    |
    | The single or recurring price to charge the customer.
    |
    */

    'billing_price' => (float) env('SHOPIFY_BILLING_PRICE', 0.00),

    /*
    |--------------------------------------------------------------------------
    | Billing Trial
    |--------------------------------------------------------------------------
    |
    | Trails days for the app. Set to 0 for no trial period.
    |
    */

    'billing_trial_days' => (int) env('SHOPIFY_BILLING_TRIAL_DAYS', 7),

    /*
    |--------------------------------------------------------------------------
    | Billing Test
    |--------------------------------------------------------------------------
    |
    | Enable or disable test mode for billing.
    | This is useful for development purposes, see Shopify's documentation.
    |
    */

    'billing_test' => (bool) env('SHOPIFY_BILLING_TEST', false),

    /*
    |--------------------------------------------------------------------------
    | Billing Redirect
    |--------------------------------------------------------------------------
    |
    | Required redirection URL for billing when
    | a customer accepts or declines the charge presented.
    |
    */

    'billing_redirect' => env('SHOPIFY_BILLING_REDIRECT', '/billing/process'),

    /*
    |--------------------------------------------------------------------------
    | Billing Capped Amount
    |--------------------------------------------------------------------------
    |
    | The capped price for charging a customer when using the UsageCharge API.
    |
    */

    'billing_capped_amount' => env('SHOPIFY_BILLING_CAPPED_AMOUNT'),

    /*
    |--------------------------------------------------------------------------
    | Billing Terms
    |--------------------------------------------------------------------------
    |
    | Terms for the usage. Required if using capped amount.
    |
    */

    'billing_terms' => env('SHOPIFY_BILLING_TERMS'),

    /*
    |--------------------------------------------------------------------------
    | Shopify Webhooks
    |--------------------------------------------------------------------------
    |
    | This option is for defining webhooks.
    | Key is for the Shopify webhook event
    | Value is for the endpoint to call
    |
    */

    'webhooks' => [
            [
                'topic' => env('SHOPIFY_WEBHOOK_1_TOPIC', 'app/uninstalled'),
                'address' => env('SHOPIFY_WEBHOOK_1_ADDRESS', 'https://cartalerts.hamsa.site/api/uninstall'),
            ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Shopify ScriptTags
    |--------------------------------------------------------------------------
    |
    | This option is for defining scripttags.
    |
    */

    'scripttags' => [
        [
            'src' => env('SHOPIFY_SCRIPTTAG_1_SRC', 'https://cartalerts.hamsa.site/public/js/cartalerts.js'),
            'event' => env('SHOPIFY_SCRIPTTAG_1_EVENT', 'onload'),
            'display_scope' => env('SHOPIFY_SCRIPTTAG_1_DISPLAY_SCOPE', 'online_store')
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | After Authenticate Job
    |--------------------------------------------------------------------------
    |
    | This option is for firing a job after a shop has been authenticated.
    | This, like webhooks and scripttag jobs, will fire every time a shop
    | authenticates, not just once.
    |
    */

    'after_authenticate_job' => [
        /*
            'job' => env('AFTER_AUTHENTICATE_JOB'), // example: \App\Jobs\AfterAuthenticateJob::class
            'inline' => env('AFTER_AUTHENTICATE_JOB_INLINE', false) // False = execute inline, true = dispatch job for later
        */
    ],
];
