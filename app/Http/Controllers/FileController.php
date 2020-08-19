<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PDFService;

class FileController extends Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->PDFService = new PDFService();
	}

    public function uploadPDF(Request $request)
	{

        try {
			// Validate the file
            $this->PDFService->validateFile('pdf');

            // Init the file
            $pdf = $request->file($expectedFile);
    
            // Make sure that the keyword proposal is present
            $this->PDFService->searchFor($pdf, 'Proposal');
    
            // Store file directory
            $fileInfo = $this->PDFService->storeFile($pdf);
            
            // Update the DB entity
            $savedPDF = $this->PDFService->saveFile($fileInfo);

            return $this->respond(Response::HTTP_CREATED, [
                'pdf_url' => $savedPDF->path,
            ]);
		} catch (Exception $e) {            
            return $this->respond(Response::HTTP_UNPROCESSABLE_ENTITY, [
                'message' => 'Unable to process your request.',
            ]);
		}        
	}
}
