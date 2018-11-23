<?php

namespace GSVnet\Users;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;

class MemberFiler {

    protected $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function fileMembers()
    {
        $transformer = new UserTransformer;
        $date = Carbon::now()->format('d-m-Y');

        $formerMembers = $this->users->getAllByType(User::FORMERMEMBER);
        $members = $this->users->getAllByType(User::MEMBER);

        $former = $transformer->collectionOfFormerMembers($formerMembers);
        $current = $transformer->collectionOfMembers($members);

        $file = Excel::create("ledenbestand-{$date}", function (LaravelExcelWriter $excel) use ($date, $former, $current) {
            $excel->setTitle("ledenbestand-{$date}");
            $excel->sheet('Oud-leden', function (LaravelExcelWorksheet $sheet) use ($former) {
                $sheet->fromArray($former);
                $sheet->setAutoFilter();
                $sheet->setAutoSize(true);
                $sheet->setColumnFormat([
                    'N' => 'General' // The phone column :)
                ]);
                $sheet->cells('A1:Z1', function(CellWriter $cells) {
                    $cells->setFontWeight(true);
                });
            });
            $excel->sheet('Leden', function (LaravelExcelWorksheet $sheet) use ($current) {
                $sheet->fromArray($current);
                $sheet->setAutoFilter();
                $sheet->setAutoSize(true);
                $sheet->setColumnFormat([
                    'L' => 'General' // Phone column
                ]);
                $sheet->cells('A1:Z1', function(CellWriter $cells) {
                    $cells->setFontWeight(true);
                });
            });
        });

        return $file;
    }
}