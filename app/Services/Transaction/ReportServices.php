<?php
namespace App\Services\Transaction;

use App\Infrastructure\Transaction\Repository\TransactionRepositoryInterface;

use Carbon\Carbon;


class ReportServices
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * ReportServices constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getReporting($time)
    {
        return $this->transactionRepository->reportByTime($time);
    }

    public function getDate($days)
    {
        return Carbon::now()->subDays($days)->toDateString();
    }

    /**
     * @param $days
     * @return array|\Illuminate\Support\Collection
     */
    public function getReportingApi($days)
    {
        $time = $this->getDate($days);
        $data = $this->transactionRepository->reportByTime($time);
        $data[] = $time;

        return $data;
    }
}
