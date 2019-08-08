<?php

namespace App\Repositories;

use App\Models\Product,
    App\Models\Comment;

class ProductRepository extends BaseRepository {


    /**
     * The Comment instance.
     *
     * @var App\Models\Comment
     */
    protected $comment;

    /**
     * Create a new ProductRepository instance.
     *
     * @param  App\Models\Product $product
     * @param  App\Models\Comment $comment
     * @return void
     */
    public function __construct(
        Product $product, Comment $comment)
    {
        $this->model = $product;
        $this->comment = $comment;
    }

    /**
     * Create or update a product.
     *
     * @param Product $product
     * @param $inputs
     * @return Product
     */
    private function savePost(Product $product, $inputs)
    {
        $product->name = $inputs['name'];
        $product->description = $inputs['description'];
        $product->save();

        return $product;
    }

    /**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'name', 'description')
                        ->latest();
    }

    /**
     * Get post collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function indexFront($n)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->paginate($n);
    }

    /**
     * Get post collection.
     *
     * @param  int  $n
     * @param  int  $id
     * @return Illuminate\Support\Collection
     */
    public function indexTag($n, $id)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->whereHas('comments', function($q) use($id) {
                            $q->where('comment.id', $id);
                        })
                        ->paginate($n);
    }

    /**
     * Get search collection.
     *
     * @param  int  $n
     * @param  string  $search
     * @return Illuminate\Support\Collection
     */
    public function search($n, $search)
    {
        $query = $this->queryActiveWithUserOrderByDate();

//        return $query->where(function($q) use ($search) {
//                    $q->where('summary', 'like', "%$search%")
//                            ->orWhere('content', 'like', "%$search%")
//                            ->orWhere('title', 'like', "%$search%");
//                })->paginate($n);
    }

    /**
     * @param $n
     * @param string $orderby
     * @param string $direction
     * @return mixed
     */
    public function index($n, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
                ->select('product.id', 'product.created_at', 'product.name', 'product.description')
                ->orderBy($orderby, $direction);

        return $query->paginate($n);
    }

    /**
     * Update a post.
     *
     * @param  array  $inputs
     * @param  App\Models\Product $product
     * @return void
     */
    public function update($inputs, $product)
    {
        $this->savePost($product, $inputs);
    }

    /**
     * Destroy a product.
     *
     * @param  App\Models\Product $product
     * @return void
     */
    public function destroy($product) {

        $product->delete();
    }

}
