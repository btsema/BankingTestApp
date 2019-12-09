<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Http\Resources\ApiException;
use App\Http\Resources\ReportingCollection;
use App\Services\Transaction\ReportServices;
use App\Services\Transaction\OptimisticLockingTransactionService;
use Illuminate\Http\RedirectResponse;

class TransactionController extends Controller
{
     /**
     * @var ReportServices
     */
    private $reportService;
    /**
     * @var OptimisticLockingTransactionService
     */
    private $optimisticLockingTransactionService;

    /**
     * TransactionController constructor.
     * @param OptimisticLockingTransactionService $optimisticLockingTransactionService
     * @param ReportServices $reportService
     */
    public function __construct(
        OptimisticLockingTransactionService $optimisticLockingTransactionService,
        ReportServices $reportService
    )
    {
        $this->optimisticLockingTransactionService = $optimisticLockingTransactionService;
        $this->reportService = $reportService;
    }

    public function index(int $days = 7)
    {
        $date = $this->reportService->getDate($days);
        $reportings = $this->reportService->getReporting($date);

        return view('reporting', compact('reportings', 'date'));
    }

    /**
     * @param int $days
     * @return ApiException|ReportingCollection
     */
    public function get(int $days = 7)
    {
        try {
            return new ReportingCollection($this->reportService->getReportingApi($days));
        } catch (\Exception $exception) {
            return new ApiException($exception);
        }
    }

    /**
     * @param DepositRequest $depositRequest
     * @return RedirectResponse
     */
    public function deposit(DepositRequest $depositRequest){
        try {
            $transactionServiceObjectValue = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
                ->setCountryId($depositRequest->get('countryIdDeposit'))
                ->setAmount($depositRequest->get('deposit'))
                ->setType($depositRequest->get('type'));

            $this->optimisticLockingTransactionService->handle(auth()->id(), $transactionServiceObjectValue);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['deposit' => $e->getMessage()]);
        }

        return redirect()
            ->back()
            ->with('success', 'Your deposit has beed added!');
    }

    public function withdraw(WithdrawRequest $withdrawRequest){
        try {
            $transactionServiceObjectValue = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
                ->setCountryId($withdrawRequest->get('countryIdWithdraw'))
                ->setAmount($withdrawRequest->get('withdraw'))
                ->setType($withdrawRequest->get('type'));

            $this->optimisticLockingTransactionService->handle(auth()->id(), $transactionServiceObjectValue);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['withdraw' => $e->getMessage()]);
        }

        return redirect()
            ->back()
            ->with('success', 'wWithdraw value has been added');
    }
 }
