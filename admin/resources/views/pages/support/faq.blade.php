@extends('pages.layouts.index')
@section('content')
    <div class="main-content app-content">
        <section class="section banner-1 banner-section banner-arrow-down">
            <img src="../assets/images/patterns/4.png" alt="img" class="patterns-3">
            <img src="../assets/images/patterns/6.png" alt="img" class="patterns-4">
            <img src="../assets/images/patterns/9.png" alt="img" class="patterns-8 op-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="">
                            <p class="mb-3 content-1 h5 text-white text-center">Câu hỏi thường gặp</p>
                            <p class="mb-0 tx-26 text-center">Mọi điều thông tin bạn cần biết về sản phẩm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row mb-4">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="web-hosting" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion accordion-style-1" id="acc-style-1">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-1" aria-expanded="false"
                                                        aria-controls="acc-1"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Lưu trữ web chia sẻ là
                                                            gì?</font></font></button>
                                            </h2>
                                            <div id="acc-1" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body"><font style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Trong Shared Web Hosting,
                                                            nhiều máy khách được lưu trữ trên một máy chủ duy nhất, tức
                                                            là các máy khách chia sẻ tài nguyên của máy chủ. Điều này
                                                            giúp giảm chi phí, vì chi phí của máy chủ và tài nguyên của
                                                            nó được phân bổ cho tất cả các máy khách/gói được lưu trữ
                                                            trên máy chủ. Shared Hosting hoàn hảo cho các trang web cá
                                                            nhân, các doanh nghiệp vừa và nhỏ không yêu cầu tất cả các
                                                            tài nguyên của một máy chủ.</font></font></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-2"
                                                        aria-expanded="false" aria-controls="acc-2"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Tôi có thể lưu trữ nhiều
                                                            trang web trong một gói lưu trữ chia sẻ không?</font></font>
                                                </button>
                                            </h2>
                                            <div id="acc-2" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes! Our Pro and Business shared hosting
                                                    plans allow you to host more than one Website, by adding secondary
                                                    domains through your hosting control panel i.e. cPanel.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-3"
                                                        aria-expanded="false" aria-controls="acc-3"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Có bảo đảm hoàn lại tiền
                                                            không?</font></font></button>
                                            </h2>
                                            <div id="acc-3" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, we offer a 100% Risk Free, 30 day Money
                                                    Back Guarantee.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-4"
                                                        aria-expanded="false" aria-controls="acc-4"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Gói dịch vụ lưu trữ email
                                                            của tôi có bao gồm không?</font></font></button>
                                            </h2>
                                            <div id="acc-4" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, all our Hosting packages come with
                                                    Unlimited Email Hosting.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-5"
                                                        aria-expanded="false" aria-controls="acc-5"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Tôi có thể nâng cấp lên gói
                                                            cao hơn không?</font></font></button>
                                            </h2>
                                            <div id="acc-5" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, you can easily upgrade to one of our
                                                    higher plans at any time.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-6"
                                                        aria-expanded="false" aria-controls="acc-6"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Dữ liệu của tôi có an toàn
                                                            không? Bạn có sao lưu không?</font></font></button>
                                            </h2>
                                            <div id="acc-6" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, your data is a 100% secure and is
                                                    backed-up every 5 days.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-7"
                                                        aria-expanded="false" aria-controls="acc-7"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Bạn có bao gồm tính năng
                                                            bảo vệ khỏi vi-rút không?</font></font></button>
                                            </h2>
                                            <div id="acc-7" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, all our servers are protected by Clam
                                                    AV.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-8"
                                                        aria-expanded="false" aria-controls="acc-8"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Tôi có thể chia nhỏ gói lưu
                                                            trữ chia sẻ của mình và bán lại không?</font></font>
                                                </button>
                                            </h2>
                                            <div id="acc-8" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">While a Shared Hosting package cannot be
                                                    used for this purpose, you can easily resell custom packages with
                                                    our Reseller Hosting. To view our Reseller Hosting plans, <a
                                                        href="linux-reseller-hosting.html" class="plain-link">click
                                                        here</a>.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-9"
                                                        aria-expanded="false" aria-controls="acc-9"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Bạn có cung cấp quyền truy
                                                            cập SSH không?</font></font></button>
                                            </h2>
                                            <div id="acc-9" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Yes, we provide SSH access to your domain.
                                                    Because this is a shared environment, you will not get root access.
                                                    However, you will be able to achieve most of your requirements by
                                                    having the rights to access only the files relevant to your domain.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-10"
                                                        aria-expanded="false" aria-controls="acc-10"><font
                                                        style="vertical-align: inherit;"><font
                                                            style="vertical-align: inherit;">Tôi có thể liên hệ với ai
                                                            nếu cần trợ giúp?</font></font></button>
                                            </h2>
                                            <div id="acc-10" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-1">
                                                <div class="accordion-body">Our Support team is always at hand to assist
                                                    you. You can take a look at all our contact details <a
                                                        href="contact-us.html" class="plain-link">here</a>.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="servers" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion accordion-style-1" id="acc-style-2">
                                        <div class="d-flex align-items-center mb-3"><span
                                                class="avatar rounded-circle bg-primary-gradient text-white me-2 tx-20"><i
                                                    class="bi bi-hdd-network"></i></span> <h4 class="mb-0">Servers</h4>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-11" aria-expanded="false"
                                                        aria-controls="acc-11"> What is the port speed of the server?
                                                </button>
                                            </h2>
                                            <div id="acc-11" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">The server uplink port speed is up to 1
                                                    Gbps.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-12"
                                                        aria-expanded="false" aria-controls="acc-12"> How long does it
                                                    take for the server to be ready?
                                                </button>
                                            </h2>
                                            <div id="acc-12" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">After the payment, your server will be
                                                    provisioned in about 30 minutes and you can access it via SSH. The
                                                    disk resize operation, however, may still run in the background for
                                                    a while after provisioning.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-13"
                                                        aria-expanded="false" aria-controls="acc-13"> What is your
                                                    backup policy?
                                                </button>
                                            </h2>
                                            <div id="acc-13" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">You are responsible for your backups and web
                                                    content. It is recommended that you keep copies of your content safe
                                                    and make your own backups. You can take a backup from your cPanel or
                                                    use a remote backup solution.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-14"
                                                        aria-expanded="false" aria-controls="acc-14"> What is the level
                                                    of support that you provide with the server?
                                                </button>
                                            </h2>
                                            <div id="acc-14" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">To ensure high uptime and accessibility at
                                                    all times, we are available 24x7 for any hardware, network, booting,
                                                    O.S. or login issues. Our System Administration Support will also
                                                    assist you with basic cPanel &amp; Firewall setup and their issues.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-15"
                                                        aria-expanded="false" aria-controls="acc-15"> Is Additional
                                                    Storage available for all server configurations?
                                                </button>
                                            </h2>
                                            <div id="acc-15" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body"><p>At present, the additional storage
                                                        feature is only available with our HDD servers in the US data
                                                        centre.</p>
                                                    <p>Would love to hear about such new features requests to help us
                                                        serve you better.</p></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-16"
                                                        aria-expanded="false" aria-controls="acc-16"> Can I use a
                                                    Dedicated Server for email marketing?
                                                </button>
                                            </h2>
                                            <div id="acc-16" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">Dedicated Servers can be used for Websites,
                                                    Databases, Custom Applications, Ecommerce, DNS, File Storage and
                                                    Emails. Emails, however, must be restricted to personal,
                                                    organisational or professional purposes. The use of Dedicated
                                                    Servers to send out mass emails/marketing is NOT recommended and can
                                                    attract penalties.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-17"
                                                        aria-expanded="false" aria-controls="acc-17"> Can I use
                                                    virtualisation software on the server?
                                                </button>
                                            </h2>
                                            <div id="acc-17" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">Our Dedicated Servers are virtualised (1:1).
                                                    Thus, nested virtualisation will not work due to network
                                                    restrictions on the host system.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-18"
                                                        aria-expanded="false" aria-controls="acc-18"> Can I use
                                                    virtualisation software on the server?
                                                </button>
                                            </h2>
                                            <div id="acc-18" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-2">
                                                <div class="accordion-body">We don’t have any backup solution at the
                                                    moment. Yet, we strongly recommend that you maintain a remote backup
                                                    to avoid any hassles during any ill-fated incident.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="ssl" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3"><span
                                            class="avatar rounded-circle bg-primary-gradient text-white me-2 tx-20"><i
                                                class="bi bi-award"></i></span> <h4 class="mb-0"> SSL Certificate</h4>
                                    </div>
                                    <div class="accordion accordion-style-1" id="acc-style-3">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-19" aria-expanded="false"
                                                        aria-controls="acc-19"> What is an SSL Certificate?
                                                </button>
                                            </h2>
                                            <div id="acc-19" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">An SSL (Secure Sockets Layer) Certificate is
                                                    a digital certificate that verifies the identity of your website and
                                                    encrypts information sent to and from your website.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-20"
                                                        aria-expanded="false" aria-controls="acc-20"> What is the
                                                    benefit of SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-20" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">An SSL encrypts your customers' sensitive
                                                    information such as their identity, personal address, debit/credit
                                                    card details, password, etc. by encrypting the data from their
                                                    computer to your web server.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-21"
                                                        aria-expanded="false" aria-controls="acc-21"> Does SSL work in
                                                    all web browsers?
                                                </button>
                                            </h2>
                                            <div id="acc-21" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body"> Yes, Comodo SSL Certificates are compatible
                                                    with all major browsers.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-22"
                                                        aria-expanded="false" aria-controls="acc-22"> How do I apply for
                                                    an SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-22" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body"> After purchase of SSL Certificate, you need
                                                    to complete the verification process with the certificate authority.
                                                    To apply for an SSL, kindly follow the steps mentioned here.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-23"
                                                        aria-expanded="false" aria-controls="acc-23"> How do I generate
                                                    a Certificate Signing Request (CSR)?
                                                </button>
                                            </h2>
                                            <div id="acc-23" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body"> You need to generate a CSR from your
                                                    control panel by providing your website and organization details.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-24"
                                                        aria-expanded="false" aria-controls="acc-24"> How do I install
                                                    an SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-24" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">After your certificate has been issued, it
                                                    will be available in your control panel. In order to install the
                                                    certificate
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-25"
                                                        aria-expanded="false" aria-controls="acc-25"> When do I need to
                                                    reissue an SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-25" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">You would need to reissue the certificate if
                                                    the organization details need to be updated.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-26"
                                                        aria-expanded="false" aria-controls="acc-26"> Can I upgrade my
                                                    SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-26" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">At the moment, you cannot upgrade/downgrade
                                                    the certificate.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-27"
                                                        aria-expanded="false" aria-controls="acc-27"> Do I need
                                                    technical knowledge to set up an SSL?
                                                </button>
                                            </h2>
                                            <div id="acc-27" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-3">
                                                <div class="accordion-body">No, you do not need to have any technical
                                                    knowledge. However, you do need to follow a few steps before the
                                                    successful installation of the certificate. For more informatio
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="backup" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3"><span
                                            class="avatar rounded-circle bg-primary-gradient text-white me-2 tx-20"><i
                                                class="bi bi-cloud"></i></span> <h4 class="mb-0"> Backup</h4></div>
                                    <div class="accordion accordion-style-1" id="acc-style-4">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-28" aria-expanded="false"
                                                        aria-controls="acc-28"> Which products can I backup using
                                                    Acronis Cyber Backup?
                                                </button>
                                            </h2>
                                            <div id="acc-28" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">Acronis Cyber Backup can be configured to
                                                    backup KVM Linux VPS, Dedicated Linux Servers, and Dedicated Windows
                                                    Servers.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-29"
                                                        aria-expanded="false" aria-controls="acc-29"> Can I backup all
                                                    my servers to the same Acronis Account?
                                                </button>
                                            </h2>
                                            <div id="acc-29" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">Yes all your servers from one server
                                                    location can be backed up under the same Acronis Account. Servers
                                                    from US will be backed under the US account and servers from India
                                                    and Hong Kong will be backed up on your Acronis Asia account Will
                                                    the Acronis Cyber Backup order get renewed if I renew my VPS or
                                                    Dedicated server?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-30"
                                                        aria-expanded="false" aria-controls="acc-30"> Will the Acronis
                                                    Cyber Backup order get renewed if I renew my VPS or Dedicated
                                                    server?
                                                </button>
                                            </h2>
                                            <div id="acc-30" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body"><p>No. Acronis has its own product lifecycle
                                                        and will not be automatically renewed with your VPS or Dedicated
                                                        Server. You will have to renew it separately.</p></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-31"
                                                        aria-expanded="false" aria-controls="acc-31"> How can I upgrade
                                                    my backup storage space?
                                                </button>
                                            </h2>
                                            <div id="acc-31" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body"><p>If you need more backup storage space you
                                                        can go to the order management page and add more storage</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-32"
                                                        aria-expanded="false" aria-controls="acc-32"> How safe is my
                                                    backup data?
                                                </button>
                                            </h2>
                                            <div id="acc-32" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">All the data that you backup will be stored
                                                    in an offsite location, so that in case of a disaster at the
                                                    location of your VPS or Dedicated Server, your backup data will
                                                    remain safe. Additionally, the backup data is encrypted and
                                                    regularly scanned for malware to ensure complete protection.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-33"
                                                        aria-expanded="false" aria-controls="acc-33"> Can I restore
                                                    backup data from one server to another?
                                                </button>
                                            </h2>
                                            <div id="acc-33" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">Yes you can backup and restore your data
                                                    from one server to another provided you have the backup agent
                                                    installed on the servers.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-34"
                                                        aria-expanded="false" aria-controls="acc-34"> Can I download the
                                                    backup files to my local machine?
                                                </button>
                                            </h2>
                                            <div id="acc-34" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">Yes you can download the backup files to
                                                    your computer / local machine from the Acronis panel. What happens
                                                    when my backup order expires?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-35"
                                                        aria-expanded="false" aria-controls="acc-35"> What happens when
                                                    my backup order expires?
                                                </button>
                                            </h2>
                                            <div id="acc-35" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-4">
                                                <div class="accordion-body">When your backup order expires, it will be
                                                    suspended and you can renew the order within 15 days to retain your
                                                    backups. However, if you fail to renew within the time period, your
                                                    order will be deleted and the backups will also be deleted.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="sitelock" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3"><span
                                            class="avatar rounded-circle bg-primary-gradient text-white me-2 tx-20"><i
                                                class="bi bi-lock"></i></span> <h4 class="mb-0">Sitelock</h4></div>
                                    <div class="accordion accordion-style-1" id="acc-style-5">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-36" aria-expanded="false"
                                                        aria-controls="acc-36"> What is SiteLock?
                                                </button>
                                            </h2>
                                            <div id="acc-36" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body">SiteLock provides simple, fast and
                                                    affordable website security to websites of all sizes. Founded in
                                                    2008, the company protects over 12 million websites worldwide. The
                                                    SiteLock cloud-based suite of products offers automated website
                                                    vulnerability detection and malware removal, DDoS protection,
                                                    website acceleration, website risk assessments, and PCI compliance.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-37"
                                                        aria-expanded="false" aria-controls="acc-37"> What does SiteLock
                                                    do?
                                                </button>
                                            </h2>
                                            <div id="acc-37" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body">SiteLock provides comprehensive website
                                                    security. It performs website daily scans to identify
                                                    vulnerabilities or malware. When vulnerabilities or malware are
                                                    found, you will be alerted immediately. Based on your SiteLock
                                                    scanner, it will automatically remove any malware on your website.
                                                    For content management system (CMS) websites, SiteLock can
                                                    automatically patch found vulnerabilities.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-38"
                                                        aria-expanded="false" aria-controls="acc-38"> What types of
                                                    issues does SiteLock scan for?
                                                </button>
                                            </h2>
                                            <div id="acc-38" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body"><p>SiteLock has the technology to perform a
                                                        comprehensive website scan that encompasses:</p>
                                                    <ul>
                                                        <li>SiteLock performs daily scans of a website's files for
                                                            malware. If malware is found, the website owner is alerted
                                                            immediately. SiteLock also offers comprehensive scans to
                                                            automatically remove the malware.
                                                        </li>
                                                        <li>SiteLock performs scans of website applications for common
                                                            vulnerabilities that could lead to a compromise.
                                                        </li>
                                                        <li>SiteLock has the technology to automatically patch
                                                            vulnerabilities in content management systems (CMS).
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-39"
                                                        aria-expanded="false" aria-controls="acc-39"> What are
                                                    vulnerabilities and malware?
                                                </button>
                                            </h2>
                                            <div id="acc-39" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body"><p>A website vulnerability is a weakness or
                                                        misconfiguration in a website or web application code that
                                                        allows an attacker to gain some level of control of the site,
                                                        and possibly the hosting server. Most vulnerabilities are
                                                        exploited through automated means, such as vulnerability
                                                        scanners and botnets.</p>
                                                    <p>Malware, short for malicious software, is used to gather
                                                        sensitive data, gain unauthorized access to websites and even
                                                        hijack computers.</p></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-40"
                                                        aria-expanded="false" aria-controls="acc-40"> Will SiteLock
                                                    impact website performance?
                                                </button>
                                            </h2>
                                            <div id="acc-40" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body">No. During a website scan, SiteLock
                                                    downloads the relevant files to a secure server and performs scans
                                                    there. There is no impact to the website content, code, bandwidth or
                                                    server resources on the website.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-41"
                                                        aria-expanded="false" aria-controls="acc-41"> What is the
                                                    SiteLock Trust Seal?
                                                </button>
                                            </h2>
                                            <div id="acc-41" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-5">
                                                <div class="accordion-body">The SiteLock Trust Seal is a
                                                    widely-recognized security badge you can display on your website. It
                                                    is a clear indication that your website is secure and malware-free.
                                                    To add the seal to your website, simply include the code snippet
                                                    that SiteLock provides in the footer area of your website.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="others" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3"><span
                                            class="avatar rounded-circle bg-primary-gradient text-white me-2 tx-20"><i
                                                class="bi bi-grid"></i></span> <h4 class="mb-0">Others</h4></div>
                                    <div class="accordion accordion-style-1" id="acc-style-6">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#acc-42" aria-expanded="false"
                                                        aria-controls="acc-42"> Do I need to know how to Code to use
                                                    Weebly?
                                                </button>
                                            </h2>
                                            <div id="acc-42" class="accordion-collapse collapse show"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">No, you do not. Weebly offers an intuitive
                                                    drag and drop builder for you to use. Add in the elements you like,
                                                    manage your online store and even update blog posts using Weebly's
                                                    editor.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-43"
                                                        aria-expanded="false" aria-controls="acc-43"> Do I get a Money
                                                    Back guarantee?
                                                </button>
                                            </h2>
                                            <div id="acc-43" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">Weebly's plans do not have a money back
                                                    period. Instead, you can try the free plan and then upgrade to a
                                                    paid one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-44"
                                                        aria-expanded="false" aria-controls="acc-44"> Will my Website be
                                                    Responsive?
                                                </button>
                                            </h2>
                                            <div id="acc-44" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">Absolutely! All of Weebly's themes and
                                                    elements are fully mobile responsive. So your customers can browse
                                                    your website.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-45"
                                                        aria-expanded="false" aria-controls="acc-45"> Do I need to
                                                    purchase hosting to host my Website?
                                                </button>
                                            </h2>
                                            <div id="acc-45" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">No! All plans come with hosting included.
                                                    Weebly handles all the backend infrastructure required to run your
                                                    Website.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-46"
                                                        aria-expanded="false" aria-controls="acc-46"> What Payment
                                                    gateways does Weebly offer?
                                                </button>
                                            </h2>
                                            <div id="acc-46" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">Weebly offers Stripe as the the payement
                                                    gateway on the Free, Starter and Pro plan. While on the Business
                                                    plan you can choose from Stripe, Square, Authorize.net and Paypal.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-47"
                                                        aria-expanded="false" aria-controls="acc-47"> Can I increase the
                                                    number of products I can sell on my Plan?
                                                </button>
                                            </h2>
                                            <div id="acc-47" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">If you want to increase the number of
                                                    products you want to manage/sell on your Website, you will need to
                                                    upgrade your plan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#acc-48"
                                                        aria-expanded="false" aria-controls="acc-48"> Do I get email
                                                    accounts with Weebly?
                                                </button>
                                            </h2>
                                            <div id="acc-48" class="accordion-collapse collapse"
                                                 data-bs-parent="#acc-style-6">
                                                <div class="accordion-body">No you do not get an email solution with
                                                    Weebly. However, you can purchase a stand alone email solution for
                                                    your business and use it with the same domain.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
