<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Support\Facades\Log;

class TransactionHelper
{
    /**
     * Execute a database transaction.
     *
     * This method begins a database transaction and tries to execute the given
     * callback. If the callback succeeds, the transaction is committed. If the
     * callback fails with a QueryException, the transaction is rolled back and
     * the exception is logged and re-thrown. If the callback fails with any
     * other exception, the transaction is rolled back, the exception is logged
     * and re-thrown.
     *
     * @param callable $callback
     * @return mixed
     */
    public static function execute(callable $callback)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Execute the callback and commit the transaction
            $result = $callback();
            DB::commit();

            return $result;
        } catch (QueryException $e) {
            // Rollback the transaction on QueryException
            DB::rollBack();

            // Log the query exception
            Log::error('Query transaction failed: ' . $e->getMessage());

            // Return a structured error response for general exceptions
            throw new Exception('Query transaction failed: ' . $e->getMessage());
        } catch (Throwable $e) {
            // Rollback the transaction on any other exception
            DB::rollBack();

            // Log the general exception
            Log::error('Transaction failed: ' . $e->getMessage());

            // Return a structured error response for general exceptions
            throw new Exception('Transaction failed: ' . $e->getMessage());
        }
    }
}
