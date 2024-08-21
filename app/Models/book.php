<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buku',
        'judul',
        'penulis',
        'tahun_terbit',
        'deskripsi',
        'gambar',
        'stok',
        'berkas',
        'category_id'
    ];

    public function scopeFilters($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('penulis', 'LIKE', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('nama', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrows()
    {
        return $this->hasMany(borrow::class);
    }

    public function scopecari($query, $filter)
    {
        return $query->where('judul', 'LIKE', '%' . $filter . '%')
            ->orWhere('penulis', 'LIKE', '%' . $filter . '%')
            ->orWhere('tahun_terbit', $filter)
            ->orWhereHas('category', function ($query) use ($filter) {
                $query->where('nama', 'LIKE', '%' . $filter . '%');
            });
    }

}
