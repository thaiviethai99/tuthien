<?php
namespace App\Http\Controllers;

use App\EmailTemplates;
use App\Models\Contact;
use App\Models\GroupContact;
use App\Models\NewFile;
use App\Models\News;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

class SptEnController extends Controller
{
    public function aboutUs()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 2)->get();
        if ($languageId == 1) {
            return view('spt_en.about_us', compact('news'));
        } else {
            return redirect('gioi-thieu');
            //return view('spt.gioi_thieu', compact('news'));
        }
    }

    public function overview()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 1)->first();
        if ($languageId == 1) {
            return view('spt_en.overview', compact('new'));
        } else {
            return redirect('gioi-thieu/tong-quan');
        }
    }

    public function corporateStructure()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 3)->first();
        if ($languageId == 1) {
            return view('spt_en.corporate_structure', compact('new'));
        } else {
            return redirect('gioi-thieu/co-cau-to-chuc');
        }
    }

    public function keyMilestone()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 2)->first();
        if ($languageId == 1) {
            return view('spt_en.key_milestone', compact('new'));
        } else {
            return redirect('gioi-thieu/lich-su-phat-trien');
        }

    }

    public function theBrand()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 5)->first();
        if ($languageId == 1) {
            return view('spt_en.the_brand', compact('new'));
        } else {
            return redirect('gioi-thieu/thuong-hieu');
        }
    }

    public function achievementsAwards()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 4)->first();
        if ($languageId == 1) {
            return view('spt_en.achievements_awards', compact('new'));
        } else {
            return redirect('gioi-thieu/giai-thuong');
        }
    }

    public function ebrochure()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.ebrochure');
        } else {
            return redirect('gioi-thieu/ebrochure');
        }
    }

    public function newsEvents()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.tintuc.new');
        } else {
            return redirect('tin-tuc');
        }
    }

    public function sptPromotion()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 14)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.promotion', compact('news'));
        } else {
            return redirect('tin-tuc/khuyen-mai-spt');
        }
    }

    public function sptNews()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 14)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.promotion', compact('news'));
        } else {
            return redirect('tin-tuc/tin-tuc');
        }
    }

    public function promotionDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.promotion_detail', compact('new'));
        } else {
            return redirect('tin-tuc/khuyen-mai-spt-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function sptNewsDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.promotion_detail', compact('new'));
        } else {
            return redirect('tin-tuc/tin-tuc-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function theMedia()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 15)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.the_media', compact('news'));
        } else {
            return redirect('tin-tuc/diem-bao-thi-truong');
        }
    }

    public function theMediaDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.media_detail', compact('new'));
        } else {
            return redirect('tin-tuc/diem-bao-thi-truong-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function investmentCooperation()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 16)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.investment_cooperation', compact('news'));
        } else {
            return redirect('tin-tuc/hop-tac-dau-tu');
        }
    }

    public function investmentCooperationDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.cooperation_detail', compact('new'));
        } else {
            return redirect('tin-tuc/hop-tac-dau-tu-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function bidding()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 17)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.bidding', compact('news'));
        } else {
            return redirect('tin-tuc/dau-thau');
        }
    }

    public function biddingDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.bidding_detail', compact('new'));
        } else {
            return redirect('tin-tuc/dau-thau-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function sptNew()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 18)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tintuc.spt_new', compact('news'));
        } else {
            return redirect('tin-tuc/hoat-dong-spt');
        }
    }

    public function sptNewDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tintuc.spt_new_detail', compact('new'));
        } else {
            return redirect('tin-tuc/hoat-dong-spt-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    /* dich vu */

    public function servicesQuality()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dichvu_chatluong', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong');
        }
    }

    public function serviceStandards()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.quan_ly_chat_luong_dich_vu', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu');
        }
    }

    public function serviceReport()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 34)->whereNotNull('title_en')->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.bao_cao_ket_qua', compact('news'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-ban-ket-qua-tu-kiem-tra-dinh-ky-chat-luong-dich-vu-vien-thong-va-ket-qua-tu-do-kiem-chi-tieu-chat-luong-cho-tung-dich-vu');
        }
    }

    public function serviceReportDetail(Request $request){
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.bao_cao_ket_qua_chi_tiet', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-ban-ket-qua-tu-kiem-tra-dinh-ky-chat-luong-dich-vu-vien-thong-va-ket-qua-tu-do-kiem-chi-tieu-chat-luong-cho-tung-dich-vu-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }



    public function customerSupport()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 20)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.thong_tin_ho_tro_khach_hang', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-thong-tin-ho-tro-khach-hang');
        }
    }

    public function complaintCusomter()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 21)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.giai_quyet_khieu_nai', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/quy-trinh-tiep-nhan-va-giai-quyet-khieu-nai-cua-khach-hang');
        }
    }

    public function addressCustomer()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 22)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.tiep_nhan_khieu_nai', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/dia-chi-so-dien-thoai-tiep-nhan-va-giai-quyet-khieu-nai-cua-khach-hang');
        }
    }

    public function qualityCommunication()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 33)->whereNotNull('title_en')->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.bao_cao_dinh_ki_chat_luong_new', compact('news'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/bao-cao-dinh-ky-chat-luong-dich-vu-vien-thong');
        }
    }

    public function qualityCommunicationDetail(Request $request)
    {
        $languageId = getLanguageId();
        $id=$request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.bao_cao_dinh_ki_chat_luong_new_chi_tiet', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/bao-cao-dinh-ky-chat-luong-dich-vu-vien-thong-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
        
    }

    public function publishedQuality()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 24)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.cong_bo_chat_luong', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/ban-cong-bo-chat-luong-cac-dich-vu-vien-thong');
        }
    }

    public function standardsTechnical()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 25)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.tieu_chuan_ki_thuat', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-quy-chuan-ki-thuat-tieu-chuan-ap-dung-cho-tung-dich-vu');
        }
    }

    public function formProvidesService()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 26)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.bieu_mau_dich_vu', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/bieu-mau-cung-cap-thong-tin-dich-vu');
        }
    }

    public function dichVuThoai()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_thoai.dich_vu_thoai');
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-thoai');
        }
    }

    public function dienThoaiCoDinh()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 727)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_thoai.dien_thoai_co_dinh', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-thoai/dien-thoai-co-dinh');
        }
    }

    public function dienThoaiDuongDaiVoip()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 728)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_thoai.dien_thoai_duong_dai', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-thoai/dien-thoai-duong-dai-voip');
        }
    }



    public function dichVuDuLieu()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_du_lieu.dich_vu_du_lieu', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-du-lieu');
        }
    }

    public function truyCapXdsl()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 27)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_du_lieu.truy_cap_xdsl', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-du-lieu/truy-nhap-internet-xdsl');
        }
    }

    public function truyCapFtth()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 28)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_du_lieu.truy_cap_ftth', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-du-lieu/truy-nhap-internet-cap-quang-ftth');
        }
    }

    public function truyCapIptv()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 29)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_du_lieu.truy_cap_iptv', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-du-lieu/truyen-hinh-internet-iptv');
        }
    }

    public function dichVuBuuChinh()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 30)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_buu_chinh.dich_vu_buu_chinh', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-buu-chinh/nhom-dich-vu-chuyen-phat-buu-chinh');
        }
    }

    /*dich vu truyen dan */
    public function dichVuTruyenDan()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_truyen_dan.dich_vu_truyen_dan');
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-truyen-dan');
        }
    }

    public function mangRiengAoVpn()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 31)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_truyen_dan.mang_rieng_ao_vpn', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-truyen-dan/mang-rieng-ao-vpn-virtual-private-network');
        }
    }

    public function kenhThueRieng()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 32)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_truyen_dan.kenh_thue_rieng', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-truyen-dan/kenh-thue-rieng-leased-line');
        }
    }

    public function dichVuKhac()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_khac.dich_vu_khac', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-khac');
        }
    }

    public function thiCongCongTrinh()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 33)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_khac.thi_cong_cong_trinh', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-khac/thi-cong-cong-trinh-va-kinh-doanh-thiet-bi-vien-thong');
        }
    }

    public function dichVuThongTin()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 34)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_khac.dich_vu_thong_tin', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/dich-vu-khac/dich-vu-thong-tin');
        }
    }

    public function dichVusWifi()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 35)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.dich_vu_khac.dich_vu_swifi', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/swifi');
        }
    }

    public function donViThanhVien()
    {
        $languageId = getLanguageId();
        if ($languageId == 1) {
            return view('spt_en.don_vi_thanh_vien.don_vi_thanh_vien');
        } else {
            return redirect('don-vi-thanh-vien');
        }
    }

    public function chiNhanhDaiDien()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 36)->first();
        if ($languageId == 1) {
            return view('spt_en.don_vi_thanh_vien.chi_nhanh_dai_dien', compact('new'));
        } else {
            return redirect('don-vi-thanh-vien/chi-nhanh-dai-dien-tai-cac-khu-vuc');
        }
    }

    public function trungTamSpt()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 37)->first();
        if ($languageId == 1) {
            return view('spt_en.don_vi_thanh_vien.trung_tam_spt', compact('new'));
        } else {
            return redirect('don-vi-thanh-vien/trung-tam-truc-thuoc-spt');
        }
    }

    /*quan he co dong */
    public function quanHeCoDong()
    {
        $languageId = getLanguageId();
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.quan_he_co_dong', compact('qhcd'));
        } else {
            return redirect('quan-he-co-dong');
        }
    }

    public function baoCaoThuongNien()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 4)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.bao_cao_thuong_nien', compact('news', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/bao-cao-thuong-nien');
        }
    }

    public function baoCaoThuongNienChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id   = $request->id;
        $new  = News::where('id', $id)->first();
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.bao_cao_thuong_nien_chi_tiet', compact('new', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/bao-cao-thuong-nien-chi-tiet/'.$new->id.'/'.vn_to_str($new->title));
        }
    }

    public function tinTucCoDong()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 5)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en',1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.tin_tuc_co_dong', compact('news', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/tin-tuc-co-dong');
        }
    }

    public function tinTucCoDongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id   = $request->id;
        $new  = News::where('id', $id)->first();
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.tin_tuc_co_dong_chi_tiet', compact('new', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/tin-tuc-co-dong-chi-tiet/'.$new->id.'/'.vn_to_str($new->title));
        }
    }

    public function daiHoiCoDongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id   = $request->id;
        $new  = News::where('id', $id)->first();
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.dai_hoi_co_dong_chi_tiet', compact('new', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/dai-hoi-co-dong-chi-tiet/'.$new->id.'/'.vn_to_str($new->title));
        }
    }

    public function coDongChienLuoc(Request $request)
    {
        $languageId = getLanguageId();
        $new  = News::where('id', 53)->first();
        $qhcd = News::where('cate_id', 32)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.co_dong_chien_luoc', compact('new', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/co-dong-chien-luoc/co-dong-chien-luoc');
        }
    }

    public function dieuLeSpt(Request $request)
    {
        $languageId = getLanguageId();
        $new  = News::where('id', 54)->first();
        $qhcd = News::where('cate_id', 32)->where('is_delete', 0)->orderBy('id', 'desc')->get();
        if ($languageId == 1) {
            return view('spt_en.quan_he_co_dong.dieu_le_spt', compact('new', 'qhcd'));
        } else {
            return redirect('quan-he-co-dong/dieu-le/dieu-le-spt-2008');
        }
    }

    public function craw(Request $request)
    {
        include base_path() . '/vendor/simplehtmldom/simple_html_dom.php';
        for ($i = 4; $i > 1; $i--) {
            $arrayData = [];
            $url       = 'https://www.spt.vn/vn/tin-tuc/khuyen-mai-spt/' . $i;
            $context   = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
            $response  = file_get_contents($url, false, $context);
            $html      = str_get_html($response);
            foreach ($html->find('.article-item-list') as $div) {
                $text = '';
                foreach ($div->find('.article-item-list-name') as $row1) {
                    $title = $row1->plaintext;
                    foreach ($row1->find('a') as $element) {
                        $href = 'https://www.spt.vn/' . rawurlencode($element->href);
                        //$href=addslashes(html_entity_decode(trim($href), ENT_QUOTES));
                    }
                }

                //echo $href."<br/>";
                foreach ($div->find('.article-item-list-date') as $row2) {
                    $dateCreated = $row2->plaintext;
                }

                foreach ($div->find('.article-item-list-des') as $row3) {
                    $description = $row3->plaintext;
                }

                foreach ($div->find('.article-item-list-img') as $row4) {
                    foreach ($row4->find('img') as $element) {
                        $imgSrc = $element->src;
                    }
                }
                //echo $title.'-'.$dateCreated.'-'.$description."</br>";
                //$u='https://www.spt.vn/vn/tin-tuc/diem-bao-thi-truong/swifi-phu-song-hoi-hoa-xuan-2017/';
                //$u=rawurlencode($u);
                $html2 = file_get_html($href);
                /*foreach($html2->find('img') as $element) {

                }*/
                foreach ($html2->find('.article-item-content') as $div) {
                    $content = $div->innertext;
                }
                //echo $title.'<br/>';
                $des = '';
                if (!empty($description)) {
                    $des = $description;
                }
                $arrayData[] = array('title' => $title, 'img' => $imgSrc, 'dateCreated' => $dateCreated, 'description' => $des, 'content' => $content);

            }
            $arrayData = array_reverse($arrayData);
            //print_r($arrayData);
            foreach ($arrayData as $key => $item) {
                $new               = new News();
                $new->title        = $item['title'];
                $new->img          = $item['img'];
                $new->summary      = $item['description'];
                $new->content      = $item['content'];
                $new->cate_id      = 14;
                $new->user_id      = 2;
                $dateCreate        = str_replace("/", "-", $item['dateCreated']);
                $new->created_date = date('Y-m-d', strtotime($dateCreate));
                $new->is_approval  = 1;
                $new->save();
                //die;
            }

        }
        echo 'chay xong';
        die;
    }

    public function crawone(Request $request)
    {
        include base_path() . '/vendor/simplehtmldom/simple_html_dom.php';
        $arrayData = [];
        $url       = 'https://www.spt.vn/vn/tin-tuc/khuyen-mai-spt/2';
        $context   = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
        $response  = file_get_contents($url, false, $context);
        $html      = str_get_html($response);
        foreach ($html->find('.article-item-list') as $div) {
            $text = '';
            foreach ($div->find('.article-item-list-name') as $row1) {
                $title = $row1->plaintext;
                foreach ($row1->find('a') as $element) {
                    $href = 'https://www.spt.vn/' . rawurlencode($element->href);
                    //$href=addslashes(html_entity_decode(trim($href), ENT_QUOTES));
                }
            }

            //echo $href."<br/>";
            foreach ($div->find('.article-item-list-date') as $row2) {
                $dateCreated = $row2->plaintext;
            }

            foreach ($div->find('.article-item-list-des') as $row3) {
                $description = $row3->plaintext;
            }

            foreach ($div->find('.article-item-list-img') as $row4) {
                foreach ($row4->find('img') as $element) {
                    $imgSrc = $element->src;
                }
            }
            //echo $title.'-'.$dateCreated.'-'.$description."</br>";
            //$u='https://www.spt.vn/vn/tin-tuc/diem-bao-thi-truong/swifi-phu-song-hoi-hoa-xuan-2017/';
            //$u=rawurlencode($u);
            $html2 = file_get_html($href);
            /*foreach($html2->find('img') as $element) {

            }*/
            foreach ($html2->find('.article-item-content') as $div) {
                $content = $div->innertext;
            }
            //echo $title.'<br/>';
            $des = '';
            if (!empty($description)) {
                $des = $description;
            }
            $arrayData[] = array('title' => $title, 'img' => $imgSrc, 'dateCreated' => $dateCreated, 'description' => $des, 'content' => $content);

        }
        $arrayData = array_reverse($arrayData);
        //print_r($arrayData);
        foreach ($arrayData as $key => $item) {
            $new               = new News();
            $new->title        = $item['title'];
            $new->img          = $item['img'];
            $new->summary      = $item['description'];
            $new->content      = $item['content'];
            $new->cate_id      = 14;
            $new->user_id      = 2;
            $dateCreate        = str_replace("/", "-", $item['dateCreated']);
            $new->created_date = date('Y-m-d', strtotime($dateCreate));
            $new->is_approval  = 1;
            $new->save();
            //die;
        }
        echo 'chay xong';
        die;
    }

    public function crawtest(Request $request)
    {
        include base_path() . '/vendor/simplehtmldom/simple_html_dom.php';
        $url       = 'https://www.spt.vn/vn/tin-tuc/hop-tac-dau-tu/3/';
        $context   = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
        $response  = file_get_contents($url, false, $context);
        $html      = str_get_html($response);
        $arrayData = [];
        foreach ($html->find('.article-item-list') as $div) {
            $text = '';
            foreach ($div->find('.article-item-list-name') as $row1) {
                $title = $row1->plaintext;
                foreach ($row1->find('a') as $element) {
                    $href = 'https://www.spt.vn/' . rawurlencode($element->href);
                    //$href=addslashes(html_entity_decode(trim($href), ENT_QUOTES));
                }
            }

            //echo $href."<br/>";
            foreach ($div->find('.article-item-list-date') as $row2) {
                $dateCreated = $row2->plaintext;
            }

            foreach ($div->find('.article-item-list-des') as $row3) {
                $description = $row3->plaintext;
            }

            foreach ($div->find('.article-item-list-img') as $row4) {
                foreach ($row4->find('img') as $element) {
                    $imgSrc = $element->src;
                }
            }
            //echo $title.'-'.$dateCreated.'-'.$description."</br>";
            //$u='https://www.spt.vn/vn/tin-tuc/diem-bao-thi-truong/swifi-phu-song-hoi-hoa-xuan-2017/';
            //$u=rawurlencode($u);
            $html2 = file_get_html($href);
            /*foreach($html2->find('img') as $element) {

            }*/
            foreach ($html2->find('.article-item-content') as $div) {
                $content = $div->innertext;
            }
            //echo $title.'<br/>';
            $arrayData[] = array('title' => $title, 'img' => $imgSrc, 'dateCreated' => $dateCreated, 'description' => $description, 'content' => $content);

        }
        $arrayData = array_reverse($arrayData);
        //print_r($arrayData);

        die;
    }

    public function downloadFile(Request $request)
    {
        $idFile    = $request->id;
        $newFile   = NewFile::where('id', $idFile)->first();
        $file_path = dirname(base_path()) . '/assets/files/' . $newFile->file_name;
        return response()->download($file_path);
    }

    public function crawfile(Request $request)
    {
        /*plaintext: Lấy nội dung (text) từ trang web
        innertext: Chỉ lấy nội dung bên trong thẻ..
        outertext: Lấy cả thẻ và nội dung bên trong.*/
        /*$url    = 'https://www.spt.vn/attachment.aspx?ID=736';
        //$source = "https://myapps.gia.edu/ReportCheckPortal/downloadReport.do?reportNo=1152872617&weight=1.35";
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        $destination = "files/test2.pdf";
        $file        = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);
        die;*/
        include base_path() . '/vendor/simplehtmldom/simple_html_dom.php';
        $arrayData = [];
        $url       = 'https://www.spt.vn/vn/quan-he-co-dong/dai-hoi-co-dong-2018/dai-hoi-co-dong-2018/';
        $context   = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
        $response  = file_get_contents($url, false, $context);
        $html      = str_get_html($response);
        foreach ($html->find('.gscai') as $div) {
            foreach ($div->find('a') as $key => $item) {
                $title = $item->innertext;
                $href  = 'https://www.spt.vn' . $item->href;
            }
            /*$u = $div->find('a',0);
            echo $u->innertext;
            die;*/
            $fileName = vn_to_str($title) . '.pdf';
            $url      = $href;
            $ch       = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $data  = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);
            $destination = "files/" . $fileName;
            $file        = fopen($destination, "w+");
            fputs($file, $data);
            fclose($file);
            $arrayData[] = array('title' => $title, 'fileName' => $fileName);
        }
        //print_r($arrayData);
        //die;
        $arrayData = array_reverse($arrayData);
        //print_r($arrayData);
        foreach ($arrayData as $key => $item) {
            $new               = new NewFile();
            $new->new_id       = 51;
            $new->title        = $item['title'];
            $new->file_name    = $item['fileName'];
            $new->created_date = date('Y-m-d');
            $new->user_id      = 2;
            $new->save();
            //die;
        }
        echo 'chay xong';
        die;
    }

    public function tuyenDung()
    {
        $languageId = getLanguageId();
        $news = News::where('cate_id', 28)->where('is_delete', 0)->where('is_active_en',1)->where('is_approval_en',1)->whereNotNull('title_en')->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.tuyen_dung', compact('news'));
        } else {
            return redirect('tuyen-dung');
        }
    }

    public function tuyenDungChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.tuyen_dung_chi_tiet', compact('new'));
        } else {
            return redirect('tuyen-dung/tuyen-dung-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

    public function lienHe(Request $request)
    {
        $languageId = getLanguageId();
        $groupContact = GroupContact::all();
        if ($languageId == 1) {
            return view('spt_en.lien_he', compact('groupContact'));
        } else {
            return redirect('lien-he');
        }
    }

    public function postLienHe(Request $request)
    {

        $messages = array(
            'name.required'    => 'Chưa nhập quý danh',
            'email.required'   => 'Chưa nhập email',
            'email.email'      => 'Email không hợp lệ',
            'mobile.required'  => 'Chưa nhập số điện thoại',
            'subject.required' => 'Chưa nhập tiêu đề',
            'content.required' => 'Chưa nhập nội dung',
        );
        $v = \Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required|email',
            'mobile'  => 'required',
            'subject' => 'required',
            'content' => 'required',
        ]);

        if ($v->fails()) {
            return redirect('contact-us')->withErrors($v->errors())->withInput();
        }

        if (isset($_POST['g-recaptcha-response'])) {
            $captcha_secret_key = '6LeDxGAUAAAAADRZh73q6d1sqijZJJpOEnWc0S_L';
            $getCaptchaResponse = $_POST['g-recaptcha-response'];
            $recaptcha          = new ReCaptcha($captcha_secret_key);
            $resp               = $recaptcha->verify($getCaptchaResponse);

            if (!$resp->isSuccess()) {
                if (array_key_exists('0', $resp->getErrorCodes())) {
                    $error_msg = $resp->getErrorCodes()[0];
                } else {
                    $error_msg = language_data('Invalid Captcha');
                }
                if ($error_msg == 'missing-input-response') {
                    $error_msg = 'Invalid Captcha';
                }

                return redirect('contact-us')->with([
                    'message'           => $error_msg,
                    'message_important' => true,
                ]);
            }
        } else {
            return redirect('contact-us')->with([
                'message'           => language_data('Invalid Captcha'),
                'message_important' => true,
            ]);
        }
        $contact                   = new Contact();
        $contact->name             = $request->name;
        $contact->email            = $request->email;
        $contact->mobile           = $request->mobile;
        $contact->subject          = $request->subject;
        $contact->group_contact_id = $request->groupContactId;
        $contact->content          = $request->content;
        $contact->created_date     = date('Y-m-d');
        $contact->save();
        //send email
        $groupConatactId = $request->groupContactId;
        switch ($groupConatactId) {
            case 1:
                $email = 'hotrokythuat@spt.vn';
                //$email='haidaica99999@gmail.com';
                break;
            case 2:
                $email = 'tcns@spt.vn';
                break;
            case 3:
                $email = 'quantriweb@spt.vn';
                break;
            case 4:
                $email = 'khachhang@spt.vn';
                break;
            case 5:
                $email = 'kttv@spt.vn';
                break;
            case 6:
                $email = 'ptda@spt.vn';
                break;
        }
        //send email after create
        $conf     = EmailTemplates::where('tplname', '=', 'Customer Send Contact Viet Nam')->first();
        $template = $conf->message;
        $subject  = $conf->subject;

        $data = array(
            'subject' => $request->subject,
            'name'    => $request->name,
            'email'   => $request->email,
            'mobile'  => $request->mobile,
            'content' => $request->content,
        );

        $message      = _render($template, $data);
        $mail_subject = _render($subject, $data);
        $body         = $message;
        $mail         = new \PHPMailer();

        $host          = env('MAIL_HOST');
        $smtp_username = env('MAIL_USERNAME');
        $stmp_password = env('MAIL_PASSWORD');
        $port          = env('MAIL_PORT');
        $secure        = env('MAIL_ENCRYPTION');

        $mail = new \PHPMailer();
        try {
            $mail->isSMTP();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ),
            ); // Set mailer to use SMTP
            $mail->Host       = $host; // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = $smtp_username; // SMTP username
            $mail->Password   = $stmp_password; // SMTP password
            $mail->SMTPSecure = $secure; // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = $port;
            $mail->CharSet    = "utf-8";

            $mail->setFrom('haitv1@spt.vn', 'spt.vn');
            $mail->addAddress($email, $request->name); // Add a recipient
            $mail->isHTML(true); // Set email format to HTML

            $mail->Subject = $mail_subject;
            $mail->Body    = $body;

            if (!$mail->send()) {
                return redirect('contact-us')->with([
                    'message'           => 'Send mail failed',
                    'message_important' => true,
                ]);
            }
        } catch (\phpmailerException $e) {
            return redirect('contact-us')->with([
                'message' => $e->getMessage(),
            ]);
        }
        return redirect('send-contact-success');
    }

    public function sendContactSuccess()
    {
        return view('spt_en.gui_lien_he_thanh_cong');
    }

    public function hopDongMauCungCapDichVu()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 35)->whereNotNull('title_en')->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.hop_dong_mau_cung_cap_dich_vu', compact('news'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/hop-dong-mau-cung-cap-dich-vu');
        }
    }

    public function hopDongMauCungCapDichVuChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.hop_dong_mau_cung_cap_dich_vu_chi_tiet', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/hop-dong-mau-cung-cap-dich-vu-chi-tiet/'.$id.'/'.vn_to_str($new->title));
        }
    }

     public function serviceProvide()
    {
        $languageId = getLanguageId();
        $new = News::where('id', 839)->first();
        if ($languageId == 1) {
            return view('spt_en.dichvu_chatluong.quan_ly_chat_luong.cac_dich_vu_dang_cung_cap', compact('new'));
        } else {
            return redirect('dich-vu-chat-luong/quan-ly-chat-luong-dich-vu/cac-dich-vu-ma-doanh-nghiep-dang-cung-cap');
        }
    }

}
