<?php

namespace App\DataTables;

use App\Models\FilterViolation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DataTables;
use App\Models\Report;

class FilterViolationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'filterviolation.action')
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FilterViolation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FilterViolation $model)
    {
        $model = Report::query()->select('report.*', 'types_violations.*', 'users.*')
                ->join('types_violations', 'types_violations.id', '=', 'report.types_id')
                ->join('users', 'users.id', '=', 'report.user_id')
                ->where('report.status', 0)
                ->where('users.role', 0)
                ->where('users.is_active', 1) // active account
                // ->whereMonth('report.reporting_date', date('m'))
                ->get();
        return DataTables::eloquent($model)->toJson();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('filterviolation-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->width(60)
                  ->addClass('text-center table table-bordered'),
            Column::make('id'),
            Column::make('Nama'),
            Column::make('Email'),
            Column::make('Akses'),
            Column::make('Status'),
            Column::make('Pelaporan'),
            Column::make('Point'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename(): string
    // {
    //     return 'FilterViolation_' . date('YmdHis');
    // }
}
