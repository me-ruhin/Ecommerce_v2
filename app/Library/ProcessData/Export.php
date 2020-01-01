<?php
/**
 * This file export data
 */
namespace App\Library\ProcessData;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export
{
    public static $filename = 'File export';
    public static $sheetname = 'Sheet name';
    public static $title = '';

    public static function export($type = "xls", $dataExport = [], $options = [])
    {
        switch ($type) {
            case 'xls':
                return self::exportExcel($dataExport, $options);
                break;
            case 'invoice':
                return self::exportInvoice($dataExport, $options);
                break;
            default:
                # code...
                break;
        }
    }

    public static function exportExcel($dataExport = [], $options = [])
    {
        $filename = $options['filename'] ?? self::$filename;
        $sheetname = $options['sheetname'] ?? self::$sheetname;
        $title = $options['title'] ?? self::$title;
        $row = empty($title) ? 1 : 2;
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setTitle(self::$sheetname);
        if ($row == 2) {
            $worksheet->getCell('A1')->setValue($title);
        }
        $worksheet->fromArray($dataExport, $nullValue = null, $startCell = 'A' . $row);
        $writer = IOFactory::createWriter($spreadsheet, "Xls");
        // $writer->save('write.xls');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $writer->save("php://output");
    }

    public static function exportInvoice($dataExport = [], $options = [])
    {
        $filename = $options['filename'] ?? self::$filename;
        $sheetname = $options['sheetname'] ?? self::$sheetname;
        $title = $options['title'] ?? self::$title;
        $row = empty($title) ? 1 : 2;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(public_path('admin/format/export/invoice.xlsx'));
        $worksheet = $spreadsheet->getActiveSheet();
        // $worksheet->getDefaultColumnDimension()->setWidth(100);
        $worksheet->setTitle(self::$sheetname);
        $worksheet->getCell('E2')->setValue(date('Y-m-d'));
        $worksheet->getCell('F2')->setValue('OrderID#' . $dataExport['id']);
//logo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
        $drawing->setName('Store logo');
        $drawing->setPath(public_path(sc_store('logo')));
        $drawing->setHeight(50);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        $drawing->setRotation(25);
        $drawing->getShadow()->setVisible(true);
        $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($worksheet);
//End logo

        $indexRow = 2;
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.customer_name') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['name']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.shipping_address') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['address']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.shipping_phone') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['phone']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.email') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['email']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.payment_method') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['payment_method'] . ':');

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.shipping_method') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['shipping_method']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.date') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['created_at']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.currency') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['currency']);

        ++$indexRow;
        $worksheet->insertNewRowBefore($indexRow, 1);
        $worksheet->getCell('A' . $indexRow)->setValue(trans('order.exchange_rate') . ':')
            ->getStyle()->getFont()->setBold(true);
        $worksheet->getCell('B' . $indexRow)->setValue($dataExport['exchange_rate']);

        $indexRowDetail = $indexRow + 3;
        if ($dataExport['details']) {
            foreach ($dataExport['details'] as $key => $detail) {
                $worksheet->fromArray($detail, $nullValue = null, $startCell = 'A' . $indexRowDetail);
                if (count($dataExport['details']) > ($key + 1)) {
                    ++$indexRowDetail;
                    $worksheet->insertNewRowBefore($indexRowDetail, 1);
                }
            }
        }

        // $worksheet->fromArray($dataExport, $nullValue = null, $startCell = 'A' . $row);
        $writer = IOFactory::createWriter($spreadsheet, "Xls");
        // $writer->save('write.xls');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $writer->save("php://output");
    }
}
