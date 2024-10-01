<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_buku',
        'judul',
        'penulis',
        'tahun_terbit',
        'deskripsi',
        'gambar',
        'berkas',
        'kunci',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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


}
