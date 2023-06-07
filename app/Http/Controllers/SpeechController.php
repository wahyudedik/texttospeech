<?php

namespace App\Http\Controllers;

use App\Models\Speech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeechController extends Controller
{
    public function index(){
        $speeches = Speech::all();
        return view('speech.index', compact('speeches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $text = $request->text;
        $audioFile = $this->textToSpeech($text);

        Speech::create([
            'text' => $text,
            'audio_file' => $audioFile,
        ]);

        return redirect()->back()->with('success', 'Text-to-speech berhasil dibuat.');
    }

    private function textToSpeech($text)
    {
        // Implementasikan logika konversi teks ke audio file disini
        // Anda dapat menggunakan library seperti Google Text-to-Speech atau eSpeak

        // Contoh:
        $filename = time() . '.mp3';
        $path = 'audio/' . $filename;
        Storage::disk('public')->put($path, 'Audio file content');

        return $path;
    }
}
