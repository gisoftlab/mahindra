<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_comments';


    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'seen',
        'content',
    ];

    /**
     * A comment belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * A comment belongs to a product.
     *
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Attach user to a  comment
     *
     * @param int|Comment $user
     *
     * @return null|bool
     */
    public function attachUser($user)
    {
        if ($this->user()->contains($user)) {
            return true;
        }
        $this->users = null;

        return $this->user()->attach($user);
    }

    /**
     * Attach product to a  comment
     *
     * @param int|Comment $product
     *
     * @return null|bool
     */
    public function attachProduct($product)
    {
        if ($this->product()->contains($product)) {
            return true;
        }
        $this->products = null;

        return $this->product()->attach($product);
    }
}
