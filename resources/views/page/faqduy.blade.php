@extends('master') @section('content')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Câu hỏi thường gặp</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Câu hỏi thường gặp</li>
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
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">1. Thông tin liên hệ</a>
                                </h5>
                            </div>
                            <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse ">
                                <div class="card-body">
                                    <p>Mọi thông tin liên hệ, khách hàng vui lòng xem tại <a href="contact" style="font-weight: bold;">đây</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingTwo" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">2. Khi mua vé online, tôi có được tích điểm hay không?</a>
                                </h5>
                            </div>
                            <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Khi bạn mua vé online trên website, bạn vẫn sẽ được tích điểm vào tài khoản thành viên. Hệ thống <strong>bkCinema</strong> sẽ không tích điểm đối với khách hàng thực hiện thanh toán không thông qua đăng nhập.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingThree" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed"> 3. Vé liệt kê trên website áp dụng cho đối tượng nào?</a>
                                </h5>
                            </div>
                            <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Trên website, giá vé tại mục Rạp/Giá Vé được áp dụng với tất cả đối tượng khách hàng. Lưu ý: giá vé sẽ có sự khác nhau đối với các ngày trong tuần, độ tuổi khách hàng và các cụm rạp khác nhau.</p>

                                    <p>Khi mua vé online, bạn chỉ có thể mua được 1 loại vé duy nhất, đó là Vé Người Lớn/ Vé Thành Viên (đối với các rạp có áp dụng chương trình giá vé thành viên) vì hiện tại, Galaxy Cinema chưa xác minh được đúng tuổi của người mua vé và sử dụng vé.</p>

                                    <p>Đối với các loại giá vé còn lại (trẻ em, HS – SV, Teenstar …) phải có giấy tờ chứng minh hoặc đo chiều cao của trẻ em đối với Vé Trẻ Em.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingFour" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="collapsed"> 4. Khi đến rạp xem phim, tôi có cần lấy vé tại quầy không?</a>
                                </h5>
                            </div>
                            <div id="collapseFour" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Đối với trường hợp mua vé online , bạn vẫn phải đến quầy vé cung cấp mã đặt vé để lấy vé vào cửa.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingFive" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="collapsed"> 5. Khi đã mua vé online, tôi nên tới rạp trước giờ chiếu bao lâu?</a>
                                </h5>
                            </div>
                            <div id="collapseFive" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Với vé đã được thanh toán online, bạn chỉ cần đến rạp trước giờ chiếu. Tuy nhiên, nên sắp xếp thời gian để đến sớm trước 15 phút để tránh các tình huống phát sinh có thể xảy ra.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingSix" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" class="collapsed">6. Tôi có thể hủy hoặc đổi vé đã mua online được không?</a>
                                </h5>
                            </div>
                            <div id="collapseSix" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Rất tiếc, hiện Galaxy Cinema chưa hỗ trợ dịch vụ hủy hoặc thay đổi thông tin vé đã thanh toán thành công. Chúng tôi chỉ thực hiện hoàn tiền trong trường giao dịch của bạn không được ghi nhận trên hệ thống của Galaxy Cinema.

                                        Trước khi tiến hành thanh toán, bạn nên kiểm tra lại chính xác <strong>Tên phim, Giờ chiếu và Rạp chiếu</strong> của bộ phim muốn xem.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingSeven" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" class="collapsed"> 7. Làm sao để thanh toán online?</a>
                                </h5>
                            </div>
                            <div id="collapseSeven" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Để thanh toán online, bạn vui lòng thực hiện các bước sau:
                                        <ul>
                                            <li>Đăng ký thành viên Galaxy Cinema và có thẻ thanh toán ATM (thẻ phải mở dịch vụ Internet Banking) hoặc thẻ Visa/Master</li>
                                            <li>Đăng nhập với tài khoản Thành Viên Galaxy Cinema của bạn.</li>
                                            <li>Vào phần Lịch chiếu/Phim đang chiếu, bạn có thể đặt vé theo tựa phim, theo ngày, hoặc theo rạp chiếu.</li>
                                            <li>Tiến hành chọn số lượng vé (tối đa 10 vé/ đơn hàng) và chọn ghế.</li>
                                            <li>Khi đến bước thanh toán, chọn loại thẻ tín dụng muốn sử dụng để thanh toán</li>
                                        </ul>
                                    </p>
                                    <p>Chọn “Thanh toán”, bạn sẽ được chuyển qua trang thanh toán trực tuyến. Hệ thống thanh toán trực tuyến của bkCinema thông qua 2 cổng thanh toán trung gian 123pay và Onepay, hỗ trợ thanh toán cho thẻ thanh toán VISA/ MasterCard/JCB (Nội địa) và hầu hết các thẻ ATM của các ngân hàng trong nước như: Vietcombank, Đông Á Bank, Vietinbank, ACB, VIB, HD Bank, Maritime Bank, Techcombank, Eximbank, Tiền Phong bank, SHB, Việt Á Bank ….</p>

                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div id="headingEight" role="tab" class="card-header">
                                <h5 class="mb-0 mt-0">
                                    <a data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" class="collapsed"> 8. Tôi có thể dùng thẻ của mình để mua vé nhóm không?</a>
                                </h5>
                            </div>
                            <div id="collapseEight" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion" class="collapse">
                                <div class="card-body">
                                    <p>Chương trình thẻ sẽ không áp dụng kèm với các chương trình ưu đãi khác, do đó bạn không thể tích lũy điềm khi mua vé nhóm. Tuy nhiên nếu bạn mua vé số lượng lớn với giá bình thường, bạn có thể nhận được điểm tương ứng cho toàn bộ số vé trên. 
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