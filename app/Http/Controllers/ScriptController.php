<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScriptController extends Controller
{
    public function run(Request $request)
    {
        // Define the absolute path to the Python interpreter and script
        $pythonPath = '/usr/bin/python3'; // Update this path as needed
        $scriptPath = base_path('mailSending/mail.py');

        // Initialize the process to run a specific task
        $process = new Process([$pythonPath, $scriptPath, 'send_mail']);

        // Run the process
        $process->run();

        // Check if the process ran successfully
        if (!$process->isSuccessful()) {
            // Log the error for debugging
            \Log::error('Python script failed: ' . $process->getErrorOutput());

            // Return the error message
            return response()->json([
                'error' => $process->getErrorOutput()
            ], 500);
        }

        // Return the output
        return response($process->getOutput(), 200)
                  ->header('Content-Type', 'text/plain');
    }
}
