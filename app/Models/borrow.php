<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'tanggal_dikembalikan',
        'denda',
        'book_id',
        'user_id'
    ];

    public function book()
    {
        return $this->belongsTo(book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopecari($query, $filters)
    {
        if (isset($filters)) {

            return $query->where('tanggal_peminjaman', 'LIKE', '%' . $filters . '%')
                ->orWhere('denda', $filters)
                ->orWhereHas('book', function ($query) use ($filters) {
                    $query->where('judul', 'LIKE', '%' . $filters . '%');
                })
                ->orWhereHas('user', function ($query) use ($filters) {
                    $query->where('name', 'LIKE', '%' . $filters . '%');
                });

        }
    }

    public function scopedenda_bulan_ini($query)
    {

        $query->whereYear('tanggal_dikembalikan', Carbon::now()->format('Y'))
            ->whereMonth('tanggal_dikembalikan', Carbon::now()->format('m'))->get();


        $data = $query->get();

        $value = 0;
        foreach ($data as $q) {
            $value += $q->denda;
        }

        return $value;

    }

    public function scopejumlah_peminjaman_bulan_ini($query)
    {

        $query->whereYear('tanggal_peminjaman', Carbon::now()->format('Y'))
            ->whereMonth('tanggal_peminjaman', Carbon::now()->format('m'))->get();

        return $query->count();
    }
}
