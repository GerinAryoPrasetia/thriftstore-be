<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\CartRepositoryInterface;



class CartController extends BaseController
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        parent::__construct();
        $this->cartRepository = $cartRepository;
    }
    //
    public function index(Request $request)
    {
        // dd($cartItems);
        return \Cart::getContent()->count();
    }

    public function addToCart(Request $request, $userId)
    {
        $fields = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
        \Cart::session($userId)->add(array(
            'id' => 456, // inique row ID
            'name' => $fields['name'],
            'price' => $fields['price'],
            'quantity' => 1,
            'attributes' => array(
                'image' => $fields['image'],
            ),
        ));

        // $cartItem = \Cart::add($fields);
        // return ($cartItem);
        return ('OK');
    }

    public function showCartItems($userId)
    {
        return \Cart::session($userId)->getContent(456);
    }
}
