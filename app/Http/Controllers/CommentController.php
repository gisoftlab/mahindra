<?php

namespace App\Http\Controllers;

;

use App\Http\Requests\UpdateComment;
use App\Http\Requests\UpdateProduct;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use jeremykenedy\Uuid\Uuid;
use Validator;
use View;

class CommentController extends Controller
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
        $comments = Comment::paginate(config('usersmanagement.paginateListSize'));

        return View('comments.list', compact('comments'));
    }

    /**
     * CreateComment
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateComment($productId)
    {
        try {

            $user = Auth::user();
            $product = Product::where('id', $productId)->firstOrFail();

            $content = request()->get('content');

            if($content) {
                $comment = Comment::create([
                    'content' => $content,
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);

                $comment->save();
                request()->session()->flash('success', 'Comment was added successfully!');
            }else{
                request()->session()->flash('error', 'Content required!');
            }

        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return redirect()->route('products.show', ['product' => $product->id]);
    }



    /**
     * Display the specified resource.
     *
     * @param int $commentId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($commentId)
    {
        try {
            $comment = Comment::findOrFail($commentId);
            $product = Product::where('id', $comment->product_id)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $routeBackTo = route('comments');
        $nameBackTo = 'comment.buttons.back-to-comments';
        if(request()->has('toProduct')){
            $routeBackTo = route('products.show', ['product' => $product->id]);
            $nameBackTo = 'product.buttons.back-to-products';
        }

        $data = [
            'product' => $product,
            'comment' => $comment,
            'routeBackTo' => $routeBackTo,
            'nameBackTo' => $nameBackTo,
        ];

        return view('comments.show')->with($data);
    }

    /**
     *
     * @param $productId
     *
     * @return mixed
     */
    public function edit($commentId)
    {
        try {
            $comment = Comment::findOrFail($commentId);
            $product = Product::where('id', $comment->product_id)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return view('pages.status')
                ->with('error', trans('comment.notFound'))
                ->with('error_title', trans('comment.notFoundTitle'));
        }

        $routeBackTo = route('comments');
        $nameBackTo = 'comment.buttons.back-to-comments';
        if(request()->has('toProduct')){
            $routeBackTo = route('products.show', ['product' => $product->id]);
            $nameBackTo = 'product.buttons.back-to-products';
        }

        $data = [
            'product' => $product,
            'comment' => $comment,
            'routeBackTo' => $routeBackTo,
            'nameBackTo' => $nameBackTo,
        ];

        return view('comments.edit')->with($data);
    }

    /**
     * Update comment
     *
     * @param \App\Http\Requests\UpdateComment $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(UpdateComment $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $input = Input::only('content');

        $comment->update($input);

        //redirect to show
        return redirect()->to($request->get('routeBackTo'));
    }

    /**
     * Approved comment
     *
     * @param \Illuminate\Http\Request $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function approved(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $product = Product::where('id', $comment->product_id)->firstOrFail();
        $comment->seen = 1;
        $comment->save();


        $routeBackTo = route('comments');
        if(request()->has('toProduct')){
            $routeBackTo = route('products.show', ['product' => $product->id]);
        }

        return redirect()->to($routeBackTo);
    }

    /**
     * Rejected comment
     *
     * @param \Illuminate\Http\Request $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function rejected(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $product = Product::where('id', $comment->product_id)->firstOrFail();
        $comment->seen = 0;
        $comment->save();

        $routeBackTo = route('comments');
        if(request()->has('toProduct')){
            $routeBackTo = route('products.show', ['product' => $product->id]);
        }

        return redirect()->to($routeBackTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $product = Product::where('id', $comment->product_id)->firstOrFail();

        $comment->delete();

        $routeBackTo = route('comments');
        if(request()->has('toProduct')){
            $routeBackTo = route('products.show', ['product' => $product->id]);
        }

        return redirect()->to($routeBackTo);
    }
}
