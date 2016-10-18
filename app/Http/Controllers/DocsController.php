<?php namespace App\Http\Controllers;

use App\Documentation\DocumentsRepository;

class DocsController extends Controller
{
    public function index(DocumentsRepository $documents, $slug)
    {
        $document = $documents->find($slug);

        if (! $document) abort(404);

        return view('pages.docs', compact('document'));
    }
}
