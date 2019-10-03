<?php
namespace App\Http\Controllers;

use App\EmailTemplates;
use App\Models\Contact;
use App\Models\GroupContact;
use App\Models\NewFile;
use App\Models\News;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;
use Session;

class SptController extends Controller
{
    public function home()
    {
        $languageId = 2;
        if (Session::has('localeId')) {
            $languageId = Session::get('localeId');
        }
        if ($languageId == 2) {
//tieng viet
            $homeList = News::where('is_home', 1)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id','desc')->get();
            return view('spt.home', compact('homeList'));
        } else {
//tieng anh
            $homeList = News::where('is_home_en', 1)->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en', 1)->whereNotNull('title_en')->orderBy('id','desc')->get();
            return view('spt_en.home', compact('homeList'));
        }
    }

    public function gioiThieu()
    {
        $languageId = getLanguageId();
        //$news       = News::where('cate_id', 2)->get();
        if ($languageId == 2) {
            return view('spt.gioi_thieu');
        } else {
            return redirect('about-us');
            //return view('spt.gioi_thieu', compact('news'));
        }

    }

    public function gioiThieuTongQuan()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 1)->first();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_tong_quan', compact('new'));
        } else {
            return redirect('about-us/overview');
        }
    }

    public function gioiThieuCoCauToChuc()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 3)->first();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_co_cau_to_chuc', compact('new'));
        } else {
            return redirect('about-us/corporate-structure');
        }
    }

    public function gioiThieuLichSuPhatTrien()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 2)->first();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_lich_su_phat_trien', compact('new'));
        } else {
            return redirect('about-us/key-milestones');
        }

    }

    public function gioiThieuThuongHieu()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 5)->first();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_thuong_hieu', compact('new'));
        } else {
            return redirect('about-us/the-brand');
        }
    }

    public function gioiThieuGiaiThuong()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 4)->first();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_giai_thuong', compact('new'));
        } else {
            return redirect('about-us/achievements-awards');
        }
    }

    public function gioiThieuEbrochure()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.gioi_thieu_ebrochure');
        } else {
            return redirect('about-us/ebrochure');
        }
    }

    public function tintuc()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.tintuc.tin_tuc');
        } else {
            return redirect('news-events');
        }
    }

    public function tinTucKhuyenMai()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 14)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.tin_tuc_khuyen_mai', compact('news'));
        } else {
            return redirect('news-events/spt-promotions');
        }
    }

    public function tinTucNew()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 14)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.tin_tuc_khuyen_mai', compact('news'));
        } else {
            return redirect('news-events/news');
        }
    }

    public function tinTucKhuyenMaiChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.tin_tuc_khuyen_mai_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/spt-promotions-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function tinTucNewChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.tin_tuc_khuyen_mai_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/news-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function diemBaoThiTruong()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 15)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.diem_bao_thi_truong', compact('news'));
        } else {
            return redirect('news-events/the-media');
        }
    }

    public function diemBaoThiTruongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.diem_bao_thi_truong_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/the-media-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function hopTacDauTu()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 16)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.hop_tac_dau_tu', compact('news'));
        } else {
            return redirect('news-events/investment-cooperation');
        }
    }

    public function hopTacDauTuChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.hop_tac_dau_tu_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/investment-cooperation-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function dauThau()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 17)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.dau_thau', compact('news'));
        } else {
            return redirect('news-events/bidding');
        }
    }

    public function dauThauChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.dau_thau_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/bidding-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function hoatDongSpt()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 18)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.tintuc.hoat_dong_spt', compact('news'));
        } else {
            return redirect('news-events/spt-news');
        }
    }

    public function hoatDongSptChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.tintuc.hoat_dong_spt_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('news-events/spt-news-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    /* dich vu */

    public function dichVuChatLuong()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dichvu_chatluong');
        } else {
            return redirect('services-quality');
        }
    }

    public function dichVuThoai()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_thoai.dich_vu_thoai');
        } else {
            return redirect('services-quality/telephone-services');
        }
    }

    public function dienThoaiCoDinh()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 727)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_thoai.dien_thoai_co_dinh', compact('new'));
        } else {
            return redirect('services-quality/telephone-services/fixed-phone-service');
        }
    }

    public function dienThoaiDuongDaiVoip()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 728)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_thoai.dien_thoai_duong_dai', compact('new'));
        } else {
            return redirect('services-quality/telephone-services/long-distance-voip');
        }
    }

    public function quanLyChatLuongDichVu()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.quan_ly_chat_luong_dich_vu');
        } else {
            return redirect('services-quality/service-standards');
        }
    }

    public function baoCaoKetQua()
    {

        $languageId = getLanguageId();
        $news       = News::where('cate_id', 34)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.bao_cao_ket_qua', compact('news'));
        } else {
            return redirect('services-quality/service-standards/the-results-of-the-self-test-periodic-quality-of-telecommunications-services-and-results-of-self-test-quality-indicators-for-each-service');
        }
    }

    public function baoCaoKetQuaChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.bao_cao_ket_qua_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('services-quality/service-standards/the-results-of-the-self-test-periodic-quality-of-telecommunications-services-and-results-of-self-test-quality-indicators-for-each-service-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }
        }
    }

    public function thongTinHoTroKhachHang()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 20)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.thong_tin_ho_tro_khach_hang', compact('new'));
        } else {
            return redirect('services-quality/service-standards/customer-support-information');
        }
    }

    public function giaiQuyetKhieuNai()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 21)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.giai_quyet_khieu_nai', compact('new'));
        } else {
            return redirect('services-quality/service-standards/process-of-receiving-and-resolving-customer-complaints');
        }
    }

    public function diaChiTiepNhanKhieuNai()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 22)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.tiep_nhan_khieu_nai', compact('new'));
        } else {
            return redirect('services-quality/service-standards/address-telephone-number-to-receive-and-resolve-customer-complaints');
        }
    }

    public function baoCaoDinhKiChatLuong()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 33)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.bao_cao_dinh_ki_chat_luong_new', compact('news'));
        } else {
            return redirect('services-quality/service-standards/reporting-periodically-the-quality-of-telecommunications-services');
        }
    }

    public function baoCaoDinhKiChatLuongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.bao_cao_dinh_ki_chat_luong_new_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('services-quality/service-standards/reporting-periodically-the-quality-of-telecommunications-services-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }
        }
    }

    public function congBoChatLuong()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 24)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.cong_bo_chat_luong', compact('new'));
        } else {
            return redirect('services-quality/service-standards/announcement-of-the-quality-of-telecommunications-services');
        }
    }

    public function tieuChuanKiThuat()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 25)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.tieu_chuan_ki_thuat', compact('new'));
        } else {
            return redirect('services-quality/service-standards/regular-standards-standard-apply-for-each-service');
        }
    }

    public function bieuMauDichVu()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 26)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.bieu_mau_dich_vu', compact('new'));
        } else {
            return redirect('services-quality/service-standards/the-form-provides-service-information');
        }
    }

    public function dichVuDuLieu()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_du_lieu.dich_vu_du_lieu');
        } else {
            return redirect('services-quality/data-services');
        }
    }

    public function truyCapXdsl()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 27)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_du_lieu.truy_cap_xdsl', compact('new'));
        } else {
            return redirect('services-quality/data-services/xdsl-broadband-internet');
        }
    }

    public function truyCapFtth()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 28)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_du_lieu.truy_cap_ftth', compact('new'));
        } else {
            return redirect('services-quality/data-services/ftth');
        }
    }

    public function truyCapIptv()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 29)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_du_lieu.truy_cap_iptv', compact('new'));
        } else {
            return redirect('services-quality/data-services/ip-television-iptv');
        }
    }

    public function dichVuBuuChinh()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 30)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_buu_chinh.dich_vu_buu_chinh', compact('new'));
        } else {
            return redirect('services-quality/postal-services/postal-delivery-services-saigon-post-sgp');
        }
    }

    /*dich vu truyen dan */
    public function dichVuTruyenDan()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_truyen_dan.dich_vu_truyen_dan');
        } else {
            return redirect('services-quality/transmission-services');
        }
    }

    public function mangRiengAoVpn()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 31)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_truyen_dan.mang_rieng_ao_vpn', compact('new'));
        } else {
            return redirect('services-quality/transmission-services/vpn-virtual-private-network');
        }
    }

    public function kenhThueRieng()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 32)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_truyen_dan.kenh_thue_rieng', compact('new'));
        } else {
            return redirect('services-quality/transmission-services/leased-line');
        }
    }

    public function dichVuKhac()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_khac.dich_vu_khac');
        } else {
            return redirect('services-quality/other-services');
        }
    }

    public function thiCongCongTrinh()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 33)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_khac.thi_cong_cong_trinh', compact('new'));
        } else {
            return redirect('services-quality/other-services/construction-trading-telecommunication-equipments');
        }
    }

    public function dichVuThongTin()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 34)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_khac.dich_vu_thong_tin', compact('new'));
        } else {
            return redirect('services-quality/other-services/content-provision');
        }
    }

    public function dichVusWifi()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 35)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.dich_vu_khac.dich_vu_swifi', compact('new'));
        } else {
            return redirect('services-quality/swifi');
        }
    }

    public function donViThanhVien()
    {
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.don_vi_thanh_vien.don_vi_thanh_vien');
        } else {
            return redirect('subsidiaries');
        }
    }

    public function chiNhanhDaiDien()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 36)->first();
        if ($languageId == 2) {
            return view('spt.don_vi_thanh_vien.chi_nhanh_dai_dien', compact('new'));
        } else {
            return redirect('subsidiaries/spt-branches');
        }
    }

    public function trungTamSpt()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 37)->first();
        if ($languageId == 2) {
            return view('spt.don_vi_thanh_vien.trung_tam_spt', compact('new'));
        } else {
            return redirect('subsidiaries/subsidiary-centers');
        }
    }

    /*quan he co dong */
    public function quanHeCoDong()
    {
        $languageId = getLanguageId();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.quan_he_co_dong', compact('qhcd'));
        } else {
            return redirect('investor-relation');
        }
    }

    public function baoCaoThuongNien()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 4)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.bao_cao_thuong_nien', compact('news', 'qhcd'));
        } else {
            return redirect('investor-relation/annual-reports');
        }
    }

    public function baoCaoThuongNienChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.bao_cao_thuong_nien_chi_tiet', compact('new', 'qhcd'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('investor-relation/annual-reports-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function tinTucCoDong()
    {
        $languageId = getLanguageId();
        $news       = News::where('cate_id', 5)->where('is_delete', 0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.tin_tuc_co_dong', compact('news', 'qhcd'));
        } else {
            return redirect('investor-relation/corporate-announcements');
        }
    }

    public function tinTucCoDongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.tin_tuc_co_dong_chi_tiet', compact('new', 'qhcd'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('investor-relation/corporate-announcements-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }

        }
    }

    public function daiHoiCoDongChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id         = $request->id;
        $new        = News::where('id', $id)->first();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.dai_hoi_co_dong_chi_tiet', compact('new', 'qhcd'));
        } else {
            $title = $new->title;
            $year  = explode(' ', $title);
            $year  = array_reverse($year);
            $year  = $year[0];
            $link='annual-general-meeting-'.$year;
            return redirect('investor-relation/annual-general-meeting-detail/' . $id . '/' .$link);
        }
    }

    public function coDongChienLuoc(Request $request)
    {
        $languageId = getLanguageId();
        $new  = News::where('id', 53)->first();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.co_dong_chien_luoc', compact('new', 'qhcd'));
        } else {
            return redirect('investor-relation/strategic-shareholders/strategic-shareholders');
        }
    }

    public function dieuLeSpt(Request $request)
    {
        $languageId = getLanguageId();
        $new  = News::where('id', 54)->first();
        $qhcd       = News::where('cate_id', 32)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->get();
        if ($languageId == 2) {
            return view('spt.quan_he_co_dong.dieu_le_spt', compact('new', 'qhcd'));
        } else {
            return redirect('investor-relation/charter');
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
        $news = News::where('cate_id', 28)->where('is_delete', 0)->where('is_active',1)->where('is_approval',1)->orderBy('id', 'desc')->paginate(5);
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.tuyen_dung',compact('news'));
        } else {
            return redirect('careers');
        }
    }

    public function tuyenDungChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id  = $request->id;
        $new = News::where('id', $id)->first();
        if($languageId==2){
            return view('spt.tuyen_dung_chi_tiet', compact('new'));
        }
        else {
            if(!empty($new->title_en)){
                return redirect('careers/careers-detail/'.$id.'/'.vn_to_str($new->title_en));
            }else{
                return redirect('/');
            }
            
        }
    }

    public function lienHe(Request $request)
    {
        $groupContact = GroupContact::all();
        $languageId = getLanguageId();
        if ($languageId == 2) {
            return view('spt.lien_he',compact('groupContact'));
        } else {
            return redirect('contact-us');
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
        ], $messages);

        if ($v->fails()) {
            return redirect('lien-he')->withErrors($v->errors())->withInput();
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
                    $error_msg = 'Chưa chọn captcha';
                }

                return redirect('lien-he')->with([
                    'message'           => $error_msg,
                    'message_important' => true,
                ]);
            }
        } else {
            return redirect('lien-he')->with([
                'message'           => language_data('Invalid Captcha'),
                'message_important' => true,
            ]);
        }
        $contact                   = new Contact();
        $contact->name             = strip_tags($request->name);
        $contact->email            = strip_tags($request->email);
        $contact->mobile           = strip_tags($request->mobile);
        $contact->subject          = strip_tags($request->subject);
        $contact->group_contact_id = (int)$request->groupContactId;
        $contact->content          = strip_tags($request->content);
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
                return redirect('lien-he')->with([
                    'message'           => 'Gửi mail thất bại',
                    'message_important' => true,
                ]);
            }
        } catch (\phpmailerException $e) {
            return redirect('lien-he')->with([
                'message' => $e->getMessage(),
            ]);
        }
        return redirect('gui-lien-he-thanh-cong');
    }

    public function sendContactSuccess()
    {
        return view('spt.gui_lien_he_thanh_cong');
    }


    public function hopDongMauCungCapDichVu()
    {

        $languageId = getLanguageId();
        $news       = News::where('cate_id', 35)->where('is_delete',0)->where('is_active',1)->where('is_approval', 1)->orderBy('id', 'desc')->paginate(5);
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.hop_dong_mau_cung_cap_dich_vu', compact('news'));
        } else {
            return redirect('services-quality/service-standards/sample-contract-for-service-delivery');
        }
    }

    public function hopDongMauCungCapDichVuChiTiet(Request $request)
    {
        $languageId = getLanguageId();
        $id = $request->id;
        $new        = News::where('id', $id)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.hop_dong_mau_cung_cap_dich_vu_chi_tiet', compact('new'));
        } else {
            if (!empty($new->title_en)) {
                return redirect('services-quality/service-standards/sample-contract-for-service-delivery-detail/' . $id . '/' . vn_to_str($new->title_en));
            } else {
                return redirect('/');
            }
        }
    }

    public function dichVuDangCungCap()
    {
        $languageId = getLanguageId();
        $new        = News::where('id', 839)->first();
        if ($languageId == 2) {
            return view('spt.dichvu_chatluong.quan_ly_chat_luong.cac_dich_vu_dang_cung_cap', compact('new'));
        } else {
            return redirect('services-quality/service-standards/the-services-that-the-business-is-providing');
        }
    }
}
