<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;

class ListingsControlController extends Controller
{
    //
    public function index() {
        return view("listingscontrol.index");
    }
    public function viewalllistings() {
        header("Content-type:application/html");
        $retHTML = "";
        $model = new Common();
        $listing_data = $model->getAllListingsData()->toArray();
        
        foreach( $listing_data as $listing ) {
            $retHTML .= "<tr class='gradeX odd' role='row'>
                    <td>".$listing->name."</td>
                    <td class='sorting_1'>".(strtoupper($listing->coin_type))."</td>
                    <td>
                        ".$listing->terms_of_trade."
                    </td>
                    <td class='center'>".$listing->payment_method."</td>
                    <td align=center>
                        <button class='view_user btn btn-success' type='button' user_id='".$listing->id."' onclick='doOnDelete(this)'>Delete
                        </button>
                    </td>
                </tr>";
        }
        echo $retHTML;
        exit;
    }
}
