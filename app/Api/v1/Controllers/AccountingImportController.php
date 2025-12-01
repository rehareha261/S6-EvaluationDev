<?php

namespace App\Api\v1\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Controllers\Controller;

class AccountingImportController extends Controller
{
    public function importCsv(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Lecture du fichier CSV
        $file = $request->file('file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            // Implémentez ici la logique d'insertion dans la base de données
            // Exemple: App\Models\AccountingEntry::create([...]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function importExcel(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        // Lecture du fichier Excel
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $index => $row) {
            if ($index === 1) continue; // Ignorer la ligne d'en-tête

            // Implémentez ici la logique d'insertion dans la base de données
            // Exemple: App\Models\AccountingEntry::create([...]);
        }

        return response()->json(['status' => 'success'], 200);
    }
}