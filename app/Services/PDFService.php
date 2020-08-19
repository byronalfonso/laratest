<?php
namespace App\Services;

class PDFService
{
	public function searchFor($pdf, $keyword)
	{
		//Psuedo code
		if (is_not_in($keyword, $pdf)){
			$this->error('Does not contain the keyword.');
		}
	}

	public function validateFile($expectedFile) {
		$this->validatePDFPayload($expectedFile);
		$file = $_FILES[$expectedFile];
		$this->validateFileExt($file);
		$this->validateFileMimeType($file);
	}

	private function validatePDFPayload($expectedFile)
	{
		if (empty($expectedFile)) {
			return;
		}

		if (!isset($_FILES[$expectedFile])) {
			$this->error('No file was uploaded.');
		}

		if ($_FILES[$expectedFile]['error'] > 0) {
			$this->error('Error was found in the file.');
		}
	}

	private function validateFileExt($filePayload)
	{
		$fileName = $filePayload['name'];
		$uploadedFileExtType = pathinfo($fileName, PATHINFO_EXTENSION);

		if ($uploadedFileExtType !== 'pdf') {
			$this->error('Invalid pdf extension.');
		}
	}

	private function validateFileMimeType($filePayload)
	{
		$uploadedFileMimeType = mime_content_type($filePayload['tmp_name']);

		if ($uploadedFileExtType !== 'pdf') {
			$this->error('Invalid pdf mimetype.');
		}
	}

	public function storeFile($file, $loc = 'pdf')
	{
		$fileInfo = [];
		$path = $file->store($loc);
		$fileRawInfo = explode('/', $path);
		$fileInfo['path'] = $path;
		$fileInfo['name'] = $fileRawInfo[1];
		$fileInfo['tempPath'] = $file->getRealPath();
		$fileInfo['originalName'] = $file->getClientOriginalName();
		$fileInfo['ext'] = $file->getClientOriginalExtension();
		$fileInfo['size'] = $file->getSize();
		$fileInfo['type'] = $file->getMimeType();
		return $fileInfo;
	}

	public function saveFile($fileInfo, $refLength)
	{
		// Check first if a file with the same name and size already exists
		$file = File::where([
			['file_name', $fileInfo['name']], 
			['file_size', $fileInfo['size']]
		])->first();
		
		// If file doesn't exist, create an entry in DB
		if(empty($file)){
			$file = new File();
		}

		$file->path = $fileInfo['path'];
		$file->mime_type = $fileInfo['type'];
		$file->file_name = $fileInfo['name'];
		$file->file_ext = $fileInfo['ext'];
		$file->file_size = $fileInfo['size'];
		$file->save();
		return $file;
	}

	private function error($msg){
		throw new Exception($msg);
	}
}
