<section id="clients-say" class="clients-say">
    <div class="container">
        <div class="section-header">
            <p>Đánh giá từ khách hàng thân thiết</p>
            <h2>Về sản phẩm của chúng tôi</h2>
        </div>
        <div class="row">
            <div class="owl-carousel testimonial-carousel">

                <?php
                $sts = 1;
                $con = mysqli_connect("localhost", "root", "", "eshop");
                $query_binhluan = mysqli_query($con, "SELECT * FROM signup a JOIN comment b on a.id_signup=b.id_account JOIN product c on b.id_product=c.id WHERE status=1 limit 4");
                while ($row = mysqli_fetch_array($query_binhluan)) {
                ?>
                    <div class="col-sm-3 col-xs-12">
                        <div class="single-testimonial-box">
                            <div class="testimonial-description">
                                <div class="testimonial-info">
                                    <div class="testimonial-img">
                                        <img src="assets/images/clients/c1.png" alt="image of clients person" />
                                    </div>
                                </div>
                                <div class="testimonial-comment">
                                    <p>
                                        <?php echo htmlentities($row['comments']); ?>
                                    </p>
                                </div>
                                <div class="testimonial-person">
                                    <h2><a href="#"><?php echo htmlentities($row['name']); ?></a></h2>
                                </div>
                            </div>
                        </div>
                    </div><!--/.col-->

                <?php } ?>

            </div>
        </div>
    </div>

</section>