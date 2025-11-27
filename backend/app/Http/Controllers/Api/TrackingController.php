<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;

class TrackingController extends Controller
{
    public function show($id)
    {
        $doc = Document::with('statuses')->find($id);

        if (!$doc) {
            return response()->json([
                'message' => 'Dokumen tidak ditemukan'
            ], 404);
        }

        // Format output
        return response()->json([
            "judul" => $doc->judul,
            "current_status" => $doc->statuses->firstWhere('done', 0) ?? $doc->statuses->last(),
            "timeline" => $doc->statuses
        ]);
    }
}
