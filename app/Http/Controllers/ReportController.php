<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dataReportApprove0()
    {
        $reports = Report::where('approve', 0)->orderBy('id', 'desc')->get();

        foreach ($reports as $report) {
            // Nếu imgagesProof là chuỗi JSON, chuyển nó thành mảng
            $report->imagesProof = is_string($report->imagesProof) ? json_decode($report->imagesProof, true) : $report->imagesProof;

            // Xoá thuộc tính image nếu có
            unset($report->image);
        }

        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $reports
        ]);
    }

    public function dataReportApprove1()
    {
        $reports = Report::where('approve', 1)->orderBy('id', 'desc')->get();

        foreach ($reports as $report) {
            // Nếu imgagesProof là chuỗi JSON, chuyển nó thành mảng
            $report->imagesProof = is_string($report->imagesProof) ? json_decode($report->imagesProof, true) : $report->imagesProof;

            // Xoá thuộc tính image nếu có
            unset($report->image);
        }

        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $reports
        ]);
    }

    public function createReport(Request $request)
    {
        $imagesProof = $request->imagesProof ?? [];

        $reports = Report::create([
            'nameScammer'   => $request->nameScammer,
            'phoneScammer'  => $request->phoneScammer,
            'bankNumber'    => $request->bankNumber,
            'bankName'      => $request->bankName,
            'contentReport' => $request->contentReport,
            'imagesProof'   => json_encode($imagesProof),
            'nameSender'    => $request->nameSender,
            'phoneSender'   => $request->phoneSender,
            'option'        => $request->option,
            'approve'       => filter_var($request->approve, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
        ]);

        return response()->json([
            'message' => 'Up Report thành công!',
            'data' => $reports
        ]);
    }

    public function updateApprove(Request $request)
    {
        $reports = Report::findOrFail($request->id);
        $reports->approve = $request->approve;
        $reports->save();

        return response()->json([
            'message' => 'Duyệt thành công!',
            'data' => $reports
        ]);
    }

    public function deleteReport(Request $request)
    {
        $reports = Report::findOrFail($request->id)->delete();

        return response()->json([
            'message' => 'Đã xoá thành công!',
            'data' => $reports
        ]);
    }

    public function dataReportToday(Request $request)
    {
        $today = now()->toDateString();
        $reports = Report::select(
            'id',
            'nameScammer',
            'phoneScammer',
            'bankNumber',
            'bankName',
            'contentReport',
            'imagesProof',
            'nameSender',
            'phoneSender',
            'option',
            'created_at'
        )
            ->where('approve', 1)
            ->whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($reports as $report) {
            // Nếu imgagesProof là chuỗi JSON, chuyển nó thành mảng
            $report->imagesProof = is_string($report->imagesProof) ? json_decode($report->imagesProof, true) : $report->imagesProof;
            $report->phoneSender = substr($report->phoneSender, 0, 3) . '****' . substr($report->phoneSender, -2);
            $report->nameSender = mb_substr($report->nameSender, 0, 5) . '****';
        }

        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $reports
        ]);
    }

    public function dataReportAll(Request $request)
    {
        $reports = Report::select(
            'id',
            'nameScammer',
            'phoneScammer',
            'bankNumber',
            'bankName',
            'contentReport',
            'imagesProof',
            'nameSender',
            'phoneSender',
            'option',
            'created_at'
        )
            ->where('approve', 1)
            ->orderBy('id', 'desc')
            ->get();
        foreach ($reports as $report) {
            // Nếu imgagesProof là chuỗi JSON, chuyển nó thành mảng
            $report->imagesProof = is_string($report->imagesProof) ? json_decode($report->imagesProof, true) : $report->imagesProof;
            $report->phoneSender = substr($report->phoneSender, 0, 3) . '****' . substr($report->phoneSender, -2);
            $report->nameSender = mb_substr($report->nameSender, 0, 5) . '****';
        }

        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $reports
        ]);
    }
}
