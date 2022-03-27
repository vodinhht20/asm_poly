<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjectsList = [
            ['code' => 'PRO1014','name' => 'Dự Án 1 (TKW)'],
            ['code' => 'PRO1041','name' => 'Dự án 1 (Ứng dụng công nghệ thông tin)'],
            ['code' => 'PRO1121','name' => 'Dự án 1 - Lập trình Mobile'],
            ['code' => 'PRO131','name' => 'Dự án 1 (UDPM.NET)'],
            ['code' => 'PRO2016','name' => 'Dự án tốt nghiệp (TKW)'],
            ['code' => 'PRO2052','name' => 'Dự án tốt nghiệp (LTMT)'],
            ['code' => 'PRO2112','name' => 'Dự án tốt nghiệp(UDPM)'],
            ['code' => 'PRO219','name' => 'Dự án TN (UDPM.NET)'],
            ['code' => 'PRO220','name' => 'Dự án TN (TKTW - Single Page Application)'],
            ['code' => 'PRO222','name' => 'Dự án TN (LTMT.IOT)'],
            ['code' => 'PRO224','name' => 'Dự án TN (TKTW - PHP Framework)'],
            ['code' => 'PRO125','name' => 'Dự án 1 (Tự động hóa)'],
            ['code' => 'PRO127','name' => 'Dự án 1 (Điện công nghiệp)'],
            ['code' => 'PRO1291','name' => 'Dự án 1 (Cơ khí)'],
            ['code' => 'PRO132','name' => 'Dự án 1(Điện - điện tử)'],
            ['code' => 'PRO214','name' => 'Dự án TN (Điện - Điện tử'],
            ['code' => 'PRO215','name' => 'Dự án TN (Tự động hóa)'],
            ['code' => 'PRO216','name' => 'Dự án TN (Điện công nghiệp)'],
            ['code' => 'PRO217','name' => 'Dự án 2 (Cơ khí)'],
            ['code' => 'PRO218','name' => 'Dự án TN (Cơ khí)'],
            ['code' => 'PRO2071','name' => 'Dự án tôt nghiệp (HDDL)'],
            ['code' => 'PRO2091','name' => 'Dự án tôt nghiệp (QTKS)'],
            ['code' => 'PRO2101','name' => 'Dự án tôt nghiệp (QTNH)'],
            ['code' => 'PRO1024','name' => 'Dự án 1 (Khối Kinh tế)'],
            ['code' => 'PRO113','name' => 'Dự án 1 (Digital Marketing)'],
            ['code' => 'PRO1131','name' => 'Dự án 1 (TMĐT)'],
            ['code' => 'PRO114','name' => 'Dự án 1 (Quan hệ công chúng)'],
            ['code' => 'PRO1141','name' => 'Dự án 1 (QHCC)'],
            ['code' => 'PRO2032','name' => 'Dự án 2 (Nghề Kế toán doanh nghiệp)'],
            ['code' => 'PRO204','name' => 'Dự án 2 (Nghề Marketing & Bán hàng)'],
            ['code' => 'PRO2042','name' => 'Dự án tốt nghiệp (Marketing vs bán hàng)'],
            ['code' => 'PRO2121','name' => 'Dự án tốt nghiệp (TMĐT)'],
            ['code' => 'PRO213','name' => 'Dự án TN (QHCC)'],
            ['code' => 'PRO2131','name' => 'Dự án tốt nghiệp (QHCC)'],
            ['code' => 'PRO1112','name' => 'Dự án 1 - Mỹ thuật đa phương tiện'],
            ['code' => 'PRO2062','name' => 'Dự án tốt nghiệp (MTĐPT)'],
            ['code' => 'PRO221','name' => 'Dự án TN (Phim và quảng cáo)'],
            ['code' => 'PRO223','name' => 'Dự án TN (Thiết kế Nội - Ngoại thất)'],
        ];
        foreach($subjectsList as $item){
            $model = new Subject();
            $model->code = $item['code'];
            $model->name = $item['name'];
            $model->save();
        }
    }
}
