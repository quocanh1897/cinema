@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Quy định & Điều khoản</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Về trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Điều khoản dịch vụ</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row bar">
            <div class="col-md-12">
                <section>

                    <div id="accordion" role="tablist">
                        <div class="card card-primary">
                            <div id="headingOne" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">1. Rủi ro cá nhân khi truy cập</a>
                                </h5>
                            </div>
                            <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse ">
                                <div class="card-body">
                                    <p>Khi truy cập vào trang web này bạn chấp thuận và đồng ý với việc có thể gặp một số rủi
                                        ro và đồng ý rằng BK Cinema cũng như các bên liên kết chịu trách nhiệm xây dựng trang
                                        web này sẽ không chịu trách nhiệm pháp lý cho bất cứ thiệt hại nào đối với với bạn
                                        dù là trực tiếp, đặc biệt, ngẫu nhiên, hậu quả để lại, bị phạt hay bất kỳ mất mát,
                                        phí tổn hoặc chi phí có thể phát sinh trực tiếp hay gián tiếp qua việc sử dụng hoặc
                                        chuyển tải dữ liệu từ trang web này, bao gồm nhưng không giới hạn bởi tất cả những
                                        ảnh hưởng do virus, tác động hoặc không tác động đến hệ thống máy vi tính, đường
                                        dây điện thoại, phá hỏng ổ cứng hay các phần mềm chương trình, các lỗi kỹ thuật khác
                                        gây cản trở hoặc trì hoãn việc truyền tải qua máy vi tính hoặc kết nối mạng.

                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingTwo" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">2. Ngưng cấp quyền sử dụng</a>
                                </h5>
                            </div>
                            <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse">
                                <div class="card-body">Các thành viên tham gia BK Cinema sẽ bị Ngưng cấp quyền sử dụng dịch vụ (xoá nội dung, lock
                                    nick, xoá nick) mà không được báo trước nếu vi phạm một trong những điều sau:
                                    <ul>
                                        <li> Đăng tải những nội dung mang tính khiêu dâm, đồi truỵ, tục tĩu, phỉ báng, hăm doạ
                                            người khác, vi phạm pháp luật hoặc dẫn tới hành vi phạm pháp.</li>
                                        <li>Spam dưới mọi hình thức tại trang web BK Cinema.</li>
                                        <li>Vi phạm các quy định khác của BK Cinema</li>
                                        <p>BK Cinema sẽ không chịu trách nhiệm hay có nghĩa vụ gì đối với các nội dung đó, và
                                            sẽ hợp tác hết mình với cơ quan luật pháp hay tòa án khi có yêu cầu công bố những
                                            hành vi đăng tải thông tin và dữ liệu trái phép này.</p>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingThree" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed"> 3. Về nội dung</a>
                                </h5>
                            </div>
                            <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion" class="collapse">
                                <div class="card-body">Các thông tin trong trang web này được cung cấp “như đã đăng tải” và không kèm theo bất kỳ
                                    cam kết nào. Ban quản trị BK Cinema không bảo đảm hay khẳng định sự đúng đắn, tính chính
                                    xác, độ tin cậy hay bất cứ chuẩn mực nào trong việc sử dụng dữ liệu hay kết qủa của việc
                                    sử dụng dữ liệu trên trang web này. Mặc dù BK Cinema luôn cố gắng đảm bảo rằng tất cả
                                    nội dung trong trang web này đều được cập nhật, chúng tôi không cam kết rằng những thông
                                    tin được đề cập còn đang hiện hành, chính xác và hoàn chỉnh. Mọi thành viên, khi sử dụng
                                    một trong các chức năng sau của BK Cinema, cần ý thức rằng những hành động của mình cần
                                    phải hoàn toàn phù hợp với luật dân sự và luật bản quyền hiện hành và chịu trách nhiệm
                                    trước pháp luật đối với nội dung mình đưa lên.

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingFour" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="collapsed"> 4. Bản quyền</a>
                                </h5>
                            </div>
                            <div id="collapseFour" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Là một trang web về điện ảnh, chúng tôi ý thức rõ ràng về việc tôn trọng bản quyền của
                                        các tác giả, tác phẩm, các sản phẩm trí tuệ về điện ảnh. BK Cinema luôn cố gắng đảm
                                        bảo rằng tất cả nội dung trên trang web hoặc liên quan đến thương hiệu BK Cinema
                                        đều hợp pháp, nhưng chúng tôi không cam kết chắc chắn rằng có thể kiểm soát mọi thông
                                        tin trên trang web. Bất kỳ hành vi xâm phạm đến bản quyền nào nếu bị phát hiện sẽ
                                        bị Ban quản trị gỡ bỏ khỏi trang web trong thời gian sớm nhất.

                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingFive" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="collapsed"> 5. Sở hữu trí tuệ</a>
                                </h5>
                            </div>
                            <div id="collapseFive" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Mọi nội dung được đăng tải trên BK Cinema, bao gồm thiết kế, logo, các phần mềm, chức
                                        năng kỹ thuật, các , hình ảnh, cấu trúc trang đều thuộc bản quyền của BK Cinema và
                                        công ty sở hữu trang web này. Nghiêm cấm mọi sao chép, sửa đổi, trưng bày, phân phát,
                                        chuyển tải, tái sử dụng thông qua công nghệ “đóng khung”, xuất bản, bán, cấp phép,
                                        tái tạo hay sử dụng bất cứ nội dung nào của trang web cho bất kỳ mục đích nào mà
                                        không có sự xác nhận bằng văn bản của Ban quản trị BK Cinema hoặc/và công ty sở hữu.

                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingSix" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" class="collapsed">6. Sử dụng thông tin</a>
                                </h5>
                            </div>
                            <div id="collapseSix" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Khi vào trang web này là bạn đã thừa nhận và đồng ý rằng mọi thông tin hay dữ liệu mà
                                        bạn chuyển đến trang web này dưới bất kỳ hình thức nào, vì vì bất kỳ lý do gì, sẽ
                                        trở thành tài sản của BK Cinema và công ty sở hữu BK Cinema. Những thông tin này
                                        sẽ được BK Cinema và công ty chủ sở hữu BK Cinema sử dụng trong quá trình phát triển
                                        sản phẩm, phát triển thương hiệu, kinh doanh sản phẩm và các hoạt động khác. Chúng
                                        tôi cam kết sẽ không chia sẻ những thông tin cá nhân (bao gồm: thông tin lý lịch,
                                        email, mật khẩu) của thành viên cho bên thứ ba nào khác mà không có sự đồng ý của
                                        thành viên đó. Người dùng BK Cinema được phép sử dụng để chia sẻ trên mạng, với điều
                                        kiện phải ghi rõ nguồn tham khảo và chủ sở hữu thông tin.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingSeven" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" class="collapsed"> 7. Sửa đổi</a>
                                </h5>
                            </div>
                            <div id="collapseSeven" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>BK Cinema có quyền thay đổi, bổ sung, thêm hoặc bớt nội dung trang web cũng như các điều
                                        khoản sử dụng vào bất cứ lúc nào.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingEight" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" class="collapsed"> 8. Kết nối với các trang web khác</a>
                                </h5>
                            </div>
                            <div id="collapseEight" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Mặc dù trang web này có thể kết nối với các trang web khác, điều đó không có nghĩa là
                                        BK Cinema trực tiếp hay gián tiếp tham gia vào việc phê chuẩn, hợp tác, tài trợ,
                                        chứng thực hay kết nạp các trang web đó, trừ khi được công bố chính thức. Khi truy
                                        cập vào trang web này là bạn đã thừa nhận và đồng ý rằng BK Cinema không kiểm soát
                                        tất cả các trang web liên kết, và BK Cinema không chịu trách nhiệm về nội dung của
                                        bất kỳ trang web ngoại lai nào, hay bất kỳ trang web nào có liên kết với trang web
                                        này.

                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Trong trường hợp có thắc mắc hoặc khiếu nại cần giải quyết hãy
                        <a href="contact">liên lạc</a> với chúng tôi, chúng tôi sẽ hỗ trợ bạn sớm nhất có thể.</p>
                </section>
            </div>
            <div class="col-sm-3">
                <!-- PAGES MENU -->


            </div>
        </div>
    </div>
</div>
@endsection