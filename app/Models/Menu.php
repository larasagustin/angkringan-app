<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
        'stok',
        'is_available'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'is_available' => 'boolean'
    ];

    /**
     * Scope untuk menu yang tersedia
     */
    public function scopeTersedia($query)
    {
        return $query->where('is_available', true)->where('stok', '>', 0);
    }

    /**
     * Scope untuk menu berdasarkan kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Cek apakah menu habis
     */
    public function getHabisAttribute()
    {
        return $this->stok == 0;
    }

    /**
     * Format harga untuk display
     */
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Cek apakah menu bisa dipesan
     */
    public function bisaDipesan()
    {
        return $this->is_available && $this->stok > 0;
    }
}