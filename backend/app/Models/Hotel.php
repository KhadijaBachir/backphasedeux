<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'price_per_night',
        'currency',
        'photo', // Chemin de stockage relatif
        'user_id'
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    /**
     * Accesseur pour 'photo'. Il retourne l'URL publique complète.
     * Cette URL fonctionnera dans le frontend.
     */
    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // CORRECTION CLÉ : Utilise asset() pour générer l'URL complète
        // Ex: https://votre-domaine.onrender.com/storage/hotels/xxxx.png
        return asset('storage/' . $value);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        // Assurez-vous que le modèle User est correctement importé ou disponible.
        // Si vous avez besoin d'importer le modèle User: use App\Models\User;
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Récupère le chemin d'origine stocké en DB pour la suppression (utilisé dans le contrôleur).
     */
    public function getRawPhotoPath()
    {
        return $this->getRawOriginal('photo');
    }

    /**
     * Scope pour les hôtels de l'utilisateur
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Vérifier si l'hôtel appartient à l'utilisateur
     */
    public function belongsToUser($userId)
    {
        return $this->user_id === $userId;
    }
}
