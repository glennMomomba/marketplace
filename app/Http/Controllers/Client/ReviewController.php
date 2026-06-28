<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Afficher les avis du client connecté
     */
    public function index()
    {
        $reviews = Review::where('user_id', Auth::id())->latest()->paginate(10);

        return view('client.reviews.index', compact('reviews'));
    }

    /**
     * Créer un nouvel avis
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment'    => 'required|string|max:1000',
            'rating'     => 'required|integer|min:1|max:5',
        ]);

        $data['user_id'] = Auth::id();

        Review::create($data);

        return redirect()->back()->with('success', 'Avis ajouté avec succès.');
    }

    /**
     * Supprimer un avis
     */
    public function destroy($id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Avis supprimé.');
    }
}
