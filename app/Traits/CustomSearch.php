<?php


namespace App\Traits;

trait CustomSearch
{

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term, $col = NULL)
    {
        $columns = implode(',', $this->searchable);
        $sql = [];
        if(is_string($col)) {
            $sql[] = "(`".$col."` LIKE '%".$term."%')";
        } else {
            foreach ($this->searchable as $column){
                $sql[] = "(`".$column."` LIKE '%".$term."%')";
            }
        }
        $query->whereRaw("(".implode(' OR ', $sql).")");

        return $query;

    }
}
