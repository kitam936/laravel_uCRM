<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new Subtotal);
    }

    public function scopeSearchOrders($query, $input = null)
        {
            if(!empty($input)){
                if(Order::where('kana', 'like', '%'.$input . '%' )
                ->orWhere('tel', 'like', $input . '%')->exists())
                {
                return $query->where('kana', 'like', '%'.$input . '%' )
                ->orWhere('tel', 'like', $input . '%');
                }
            }
        }

    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        if(is_null($startDate) && is_null($endDate))
        { return $query;}

        if(!is_null($startDate) && is_null($endDate))
        { return $query->where('created_at',">=",$startDate);}

        if(is_null($startDate) && !is_null($endDate))
        {
            $endDate1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at',"<=",$endDate1);}

        if(!is_null($startDate) && !is_null($endDate))
        {
            $endDate1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at',">=",$startDate)
            ->where('created_at',"<=",$endDate1);}
    }

}
