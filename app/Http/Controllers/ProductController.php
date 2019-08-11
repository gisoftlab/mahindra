<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProduct;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\Uuid\Uuid;
use Validator;
use View;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(config('usersmanagement.paginateListSize'));

        return View('products.list', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($productId)
    {
        $user = Auth::user();

        $comments = [];
        try {
            $product = Product::findOrFail($productId);
            if ($user->isAdmin()) {
                $comments = Comment::where('product_id', $product->id)->get();
            }else{
                $comments = Comment::where('product_id', $product->id)
                    ->where('seen', '=', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $data = [
            'product' => $product,
            'comments' => $comments,
        ];

        return view('products.show')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->with(['product' => new Product()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::only('name', 'description');
        Product::create($input);
        return redirect('products');
    }


    /**
     *
     * @param $productId
     *
     * @return mixed
     */
    public function edit($productId)
    {
        try {
            $product = Product::findOrFail($productId);
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', trans('product.notFound'))
                ->with('error_title', trans('product.notFoundTitle'));
        }

        $data = [
            'product' => $product,
        ];

        return view('products.edit')->with($data);
    }

    /**
     * Update product
     *
     * @param \App\Http\Requests\UpdateProduct $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(UpdateProduct $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $input = Input::only('name', 'description');

        $product->update($input);

        //redirect to list
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('products');
    }
}
