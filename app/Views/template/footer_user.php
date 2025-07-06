<footer class="footer">
    <div class="footer-top">
        <div class="logo-brand">
            <img src="<?= base_url('image/logo_toko_online.png') ?>" alt="logo">
            <h2 class="footer-brand">DAGANGIN.MART</h2>
        </div>

        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
            <a href="#"><i class="fa-brands fa-weixin"></i></a>
        </div>
    </div>

    <hr class="footer-line">

    <div class="footer-links">
        <a href="#">HOME</a>
        <a href="#">ABOUT ME</a>
        <a href="#">ALL PRODUCT</a>
        <a href="#">CONTACT</a>
    </div>

    <div class="footer-copy">
        &copy; 2025 DAGANGIN.MART
    </div>
</footer>

<style>
.footer {
    background-color: #0675a9;
    color: #fff;
    padding: 40px 20px;
    text-align: center;
}

.footer-brand {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: white;
}

.footer-top {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.logo-brand {
    display: flex;
    align-items: center;
    gap: 1rem;
    justify-content: center;
}

.footer-top img {
    width: 50px;
    padding: 10px;
    border-radius: 7px;
    background-color: #ffffff;
}

.social-icons {
    display: flex;
    gap: 20px;
}

.social-icons a {
    color: #fff;
    font-size: 20px;
    border: 1px solid #fff;
    border-radius: 50%;
    text-decoration: none;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background 0.3s;
}

.social-icons a:hover {
    background-color: #fff;
    color: #000;
}

.footer-line {
    border: 0;
    height: 1px;
    background-color: #a9a9a9;
    margin: 30px 0;
}

.footer-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    font-size: 12px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: #ccc;
}

.footer-copy {
    margin-top: 30px;
    font-size: 12px;
    color: #d3d3d3;
}
</style>