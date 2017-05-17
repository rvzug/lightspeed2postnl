<?php

namespace App\Http\Controllers;

use App\Jobs\ReindexLightspeed;
use App\LightspeedAttribute;
use App\LightspeedAttributes;
use App\LightspeedBrand;
use App\LightspeedBrands;
use App\LightspeedCategoriesProduct;
use App\LightspeedCategory;
use App\LightspeedDeliverydate;
use App\LightspeedMetafield;
use App\LightspeedProduct;
use App\LightspeedReview;
use App\LightspeedSupplier;
use App\LightspeedTag;
use App\LightspeedType;
use App\LightspeedTypesAttribute;
use App\LightspeedVariant;
use App\LightspeedVariantsMovement;
use Gunharth\Lightspeed\Lightspeed;

class SyncController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sync');
    }

    public function reindex($resource = null)
    {

        if($resource == null)
            return back()->withErrors("No sync resource given");

        if(!method_exists(new Lightspeed(), $resource))
            return back()->withErrors(sprintf("No sync resource found matching: %s", $resource));

        switch ($resource)
        {
            case "deliverydates":
                $model = new LightspeedDeliverydate();
                break;
            case "brands":
                $model = new LightspeedBrand();
                break;
            case "suppliers":
                $model = new LightspeedSupplier();
                break;
            case "categories":
                $model = new LightspeedCategory();
                break;
            case "types":
                $model = new LightspeedType();
                break;
            case "tags":
                $model = new LightspeedTag();
                break;
            case "reviews":
                $model = new LightspeedReview();
                break;
            case "attributes":
                $model = new LightspeedAttribute();
                break;
            case "typesattributes":
                $model = new LightspeedTypesAttribute();
                break;
            case "categoriesproducts":
                $model = new LightspeedCategoriesProduct();
                break;
            case "metafields":
                $model = new LightspeedMetafield();
                break;
            case "variantsmovements":
                $model = new LightspeedVariantsMovement();
                break;


            case "products":
                $model = new LightspeedProduct();
                break;
            case "variants":
                $model = new LightspeedVariant();
                break;
        }


        dispatch(new ReindexLightspeed(get_class($model), $resource));
        return back()->withErrors("requrested");
    }
}
