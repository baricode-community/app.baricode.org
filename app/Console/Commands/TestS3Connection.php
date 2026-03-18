<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestS3Connection extends Command
{
    protected $signature = 'test:s3-connection';

    protected $description = 'Test S3 connection and credentials';

    public function handle()
    {
        try {
            $this->info('🔍 Testing S3 Connection...');

            // Test 1: Coba akses bucket
            $this->info("\n1. Checking bucket access...");
            $files = Storage::disk('s3')->files();
            $this->info('✅ Bucket is accessible! Found '.count($files).' files');

            // Test 2: Coba upload file
            $this->info("\n2. Testing file upload...");
            $testFile = 'test-'.time().'.txt';
            Storage::disk('s3')->put($testFile, 'Test content from Artisan');
            $this->info('✅ File uploaded successfully: '.$testFile);

            // Test 3: Coba download file
            $this->info("\n3. Testing file retrieval...");
            $content = Storage::disk('s3')->get($testFile);
            $this->info('✅ File retrieved: '.$content);

            // Test 4: Hapus file test
            $this->info("\n4. Cleaning up test file...");
            Storage::disk('s3')->delete($testFile);
            $this->info('✅ Test file deleted');

            $this->info("\n✨ S3 Connection is working perfectly!");

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ S3 Connection Failed!');
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
