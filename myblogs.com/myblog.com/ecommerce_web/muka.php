<?php
require_once __DIR__ . '/../model/koneksi.php';

try {
    $database = new Koneksi();
    $conn = $database->getConnection();

    $query = "SELECT * FROM produk LIMIT 8";
    $produk = $conn->query($query);

    if (!$produk) {
        throw new Exception("Error mengambil data produk: " . $conn->error);
    }
} catch (Exception $e) {
    // Log the error and show user-friendly message
    error_log($e->getMessage());
    $error_message = "Terjadi kesalahan saat memuat produk. Silakan coba lagi nanti.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BeautyShop - Toko Kecantikan Online Terlengkap">
    <title>BeautyShop - Toko Kecantikan Online</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="main-header">
      <div class="top-banner">
    <img src="img/benner.gif" alt="Promo Banner" />
    <img src="img/benner2.png" alt="Promo Banner 2" />
  </div>

  <div class="container">
    <!-- Kiri: Logo -->
    <div class="header-left">
      <div class="logo">soci<span>olla</span> <sup>10<sup>th</sup></sup></div>
    </div>

  <div class="container">
    <!-- Kiri: Logo -->
    <div class="header-left">
      <div class="logo">soci<span>olla</span> <sup>10<sup>th</sup></sup></div>
    </div>

    <!-- Tengah: Navigasi + Search -->
    <nav class="main-nav">
      <a href="#" class="active">SOCIOLLA</a>
      <a href="lilla/index.php">LILLA</a>
      <a href="bj/index.php">BEAUTY JOURNAL</a>
      <a href="soco/index.php">SOCO</a>
      <div class="search-box">
        <input type="text" placeholder="" id="searchInput">
        <button onclick="searchProduct()"><i class="fas fa-search"></i></button>
      </div>
    </nav>

    <!-- Kanan: Ikon akun dan keranjang -->
    <div class="header-right">
      <div class="account-icons">
        <a href="./../admin/login.php" aria-label="Login"><i class="fas fa-user"></i></a>
        <a href="#" aria-label="Keranjang Belanja"><i class="fas fa-shopping-cart"></i></a>
      </div>
    </div>
  </div>

  <!-- Menu Kategori bawah header -->
  <div class="sub-menu">
    <div class="container">
      <a href="#"><i class="fas fa-th-large"></i> Categories</a>
      <a href="#"><i class="fas fa-tag"></i> Brands</a>
      <a href="#"><i class="fas fa-percentage"></i> Bestie Deals</a>
      <a href="#"><i class="fas fa-gift"></i> New Arrivals</a>
      <a href="#"><i class="fas fa-star"></i> Best Seller</a>
      <a href="#"><i class="fas fa-credit-card"></i> E-Gift Card</a>
      <span class="promo-text">BYE RAMBUT FRIZZY 💁‍♀️ KECINTAAN BESTIE~ TSUBAKI UP TO 30%</span>
    </div>
  </div>
</header>

<main class="container">
    <?php if (isset($error_message)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <section class="categories">
        <h2><i class="fas fa-tags"></i> Kategori Populer</h2>
        <div class="category-grid">
            <div class="category-item">
                <img src="img/kategori-skincare.jpg" alt="Skincare" loading="lazy">
                <span>Skincare</span>
            </div>
            <div class="category-item">
                <img src="img/kategori-makeup.jpg" alt="Makeup" loading="lazy">
                <span>Makeup</span>
            </div>
            <div class="category-item">
                <img src="img/kategori-hair.jpg" alt="Perawatan Rambut" loading="lazy">
                <span>Perawatan Rambut</span>
            </div>
            <div class="category-item">
                <img src="img/kategori-body.jpg" alt="Perawatan Tubuh" loading="lazy">
                <span>Perawatan Tubuh</span>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="section-header">
            <h2><i class="fas fa-star"></i> Produk Unggulan</h2>
            <a href="#" class="see-all">Lihat Semua</a>
        </div>
        <div class="produk-grid">
            <?php while($p = $produk->fetch_assoc()): ?>
            <div class="produk-item">
                <div class="product-badge">BESTSELLER</div>
                <img src="img/<?php echo isset($p['gambar']) ? htmlspecialchars($p['gambar']) : 'default.jpg'; ?>" 
                     alt="<?php echo htmlspecialchars($p['nama'] ?? 'Produk'); ?>" 
                     loading="lazy">
                <h3><?php echo htmlspecialchars($p['nama'] ?? 'Tanpa Nama'); ?></h3>
                <div class="product-brand"><?php echo htmlspecialchars($p['brand'] ?? 'Tidak ada brand'); ?></div>
                <div class="product-price">Rp <?php echo isset($p['harga']) ? number_format($p['harga'], 0, ',', '.') : '0'; ?></div>
                <button class="btn btn-add-to-cart"><i class="fas fa-shopping-cart"></i> Tambah</button>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<footer class="rakuten-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-column">
                <h3 class="footer-heading">TENTANG KAMI</h3>
                <ul class="footer-links">
                    <li><a href="#">Profil Perusahaan</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-heading">BANTUAN</h3>
                <ul class="footer-links">
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Cara Berbelanja</a></li>
                    <li><a href="#">Pengiriman</a></li>
                    <li><a href="#">Pengembalian</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-heading">HUBUNGI KAMI</h3>
                <ul class="footer-links">
                    <li><a href="#">Live Chat</a></li>
                    <li><a href="#">Email Kami</a></li>
                    <li><a href="tel:02112345678">(021) 1234-5678</a></li>
                    <li><a href="#">Alamat Kantor</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3 class="footer-heading">IKUTI KAMI</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-divider"></div>
        
        <div class="footer-bottom">
            <div class="footer-logo">Beauty<span>Shop</span></div>
            <p class="footer-copyright">© <?php echo date('Y'); ?> BeautyShop. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>