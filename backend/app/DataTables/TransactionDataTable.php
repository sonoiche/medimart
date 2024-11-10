<?php

namespace App\DataTables;

use App\Models\Client\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function (Transaction $transaction) {
                return $transaction->created_at->format('d M, Y');
            })
            ->editColumn('customer_name', function (Transaction $transaction) {
                return $transaction->customer->name ?? '';
            })
            ->editColumn('seller_name', function (Transaction $transaction) {
                return $transaction->seller->name ?? '';
            })
            ->editColumn('proof_of_payment', function (Transaction $transaction) {
                return '<a href="'.config('app_url').'/storage/uploads/'.basename($transaction->proof_of_payment).'" target="_blank">Download</a>';
            })
            ->addColumn('action', 'client.transactions.action')
            ->rawColumns(['proof_of_payment','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->join('products','products.id','=','transactions.product_id')
            ->select('transactions.*','products.title','products.price')
            ->with(['customer','seller'])
            ->where('seller_id', auth()->user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make(['data' => 'created_at', 'title' => 'Date Added']),
            Column::make(['data' => 'title', 'title' => 'Product Name']),
            Column::make(['data' => 'customer_name', 'title' => 'Customer Name']),
            Column::make(['data' => 'price', 'title' => 'Product Price']),
            Column::make(['data' => 'transaction_type', 'title' => 'Status']),
            Column::make(['data' => 'payment_method', 'title' => 'Payment Method']),
            Column::make(['data' => 'proof_of_payment', 'title' => 'Proof']),
            Column::make(['data' => 'seller_name', 'title' => 'Seller Name']),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
