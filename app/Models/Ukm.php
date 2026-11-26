<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class Ukm extends Model
{
    protected $table = 'ukm';

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
    ];

    // Route Model Binding menggunakan kode
    public function getRouteKeyName(): string
    {
        return 'kode';
    }
    

    // Relasi Many to Many dengan Mahasiswa
    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'keanggotaan',
            'ukm_id',
            'mahasiswa_id'
        )
        ->withPivot('jabatan', 'bergabung_pada')
        ->withTimestamps();
    }

    

    #[Scope]
protected function kategori(
    Builder $query,
    ?string $kategori
): void {
    if ($kategori !== null && $kategori !== '') {
        $query->where('kategori', $kategori);
    }
}
}
