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

        $members = $this->users->getAllByType(User::MEMBER);
        $reunists = $this->users->getAllByType(User::REUNIST);
        $exMembers = $this->users->getAllByType(User::EXMEMBER);

        $memberData = $transformer->collectionOfMembers($members);
        $reunistData = $transformer->collectionOfReunists($reunists);
        $exMemberData = $transformer->collectionOfExMembers($exMembers);

        $file = Excel::create("ledenbestand-{$date}", function (LaravelExcelWriter $excel) use ($date, $former, $current) {
            $excel->setTitle("ledenbestand-{$date}");
            $excel->sheet('Oud-leden', function (LaravelExcelWorksheet $sheet) use ($exMemberData) {
                $sheet->fromArray($exMemberData);
                $sheet->setAutoFilter();
                $sheet->setAutoSize(true);
                $sheet->cells('A1:Z1', function(CellWriter $cells) {
                    $cells->setFontWeight(true);
                });
            });
            $excel->sheet('Reünisten', function (LaravelExcelWorksheet $sheet) use ($reunistData) {
                $sheet->fromArray($reunistData);
                $sheet->setAutoFilter();
                $sheet->setAutoSize(true);
                $sheet->setColumnFormat([
                    'N' => 'General' // The phone column :)
                ]);
                $sheet->cells('A1:Z1', function(CellWriter $cells) {
                    $cells->setFontWeight(true);
                });
            });
            $excel->sheet('Leden', function (LaravelExcelWorksheet $sheet) use ($memberData) {
                $sheet->fromArray($memberData);
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