<?php

// Do exactly like this file to create global method
// Just change the method name
// The best practice is using underscore (_) as prefix the method name
// Best Practice Class Name Example: _sendEmail, _deleteData, ect.

use App\Entities\Model;
use App\Models\BaseModel;
use Carbon\Carbon;

if (!function_exists('filterData')) {
    function filterData($q, $data)
    {
        foreach ($data as $column => $operators) {
            $column = str_replace('->', '.', $column);
            // check is column exist
            foreach ($operators as $operator => $value) {
                try {
                    $value = Carbon::createFromFormat('d-m-Y', $value, 'Asia/Jakarta');
                    if (strpos($column, '.') !== false) {
                        if (count(explode('.', $column)) > 2) {
                            $relation = '';
                            $serachColumn = '';
                            foreach (explode('.', $column) as $k => $single_column) {
                                if ($k == (count(explode('.', $column)) - 1)) {
                                    $serachColumn = $single_column;
                                    break;
                                }
                                $relation .= $single_column;
                                if ($k != (count(explode('.', $column)) - 2))
                                    $relation .= '.';
                            }
                            $q->whereHas($relation, function ($r) use ($serachColumn, $operator, $value) {
                                $r->whereDate($serachColumn, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                            });
                        } else {
                            $q->whereHas(explode('.', $column)[0], function ($r) use ($column, $operator, $value) {
                                $r->whereDate(explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                            });
                        }
                    } else
                        $q->whereDate($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                } catch (Exception $e) {
                    if ($operator == 'is') {
                        if (in_array($value, ['NULL', 'null',''])) {
                            $q->whereNull($column);
                        } else {
                            $q->whereNotNull($column);
                        }
                    } else {
                        if ($value) {
                            if (strpos($column, '.') !== false) {
                                if (count(explode('.', $column)) > 2) {
                                    $relation = '';
                                    $serachColumn = '';
                                    foreach (explode('.', $column) as $k => $single_column) {
                                        if ($k == (count(explode('.', $column)) - 1)) {
                                            $serachColumn = $single_column;
                                            break;
                                        }
                                        $relation .= $single_column;
                                        if ($k != (count(explode('.', $column)) - 2))
                                            $relation .= '.';
                                    }
                                    if (in_array($operator,['l','il'])) {
                                        $q->whereHas($relation, function ($r) use ($serachColumn, $operator, $value) {
                                            $r->where($serachColumn, optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                                        });
                                    } else {
                                        $q->whereHas($relation, function ($r) use ($serachColumn, $operator, $value) {
                                            $r->where($serachColumn, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                        });
                                    }
                                } else {
                                    if (in_array($operator,['l','il'])) {
                                        $q->whereHas(explode('.', $column)[0], function ($r) use ($column, $operator, $value) {
                                            $r->where(explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                                        });
                                    } else {
                                        $q->whereHas(explode('.', $column)[0], function ($r) use ($column, $operator, $value) {
                                            $r->where(explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                        });
                                    }
                                }
                            } else {
                                if (in_array($operator,['l','il']))
                                    $q->where($column, optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                                else {
                                    $q->where($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
