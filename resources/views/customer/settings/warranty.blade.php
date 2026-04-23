@include('customer.partial.header')
@include('customer.partial.navonly')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h3 class="mb-4 font-weight-bold text-center">
                        🛡️ Warranty Policy - NEEDO+
                    </h3>

                    <p class="text-muted text-center mb-4">
                        সর্বশেষ আপডেট: {{ date('d M Y') }}
                    </p>

                    <h5>১. ৭ দিনের রিপ্লেসমেন্ট গ্যারান্টি</h5>
                    <p>
                        পণ্য ডেলিভারির পর যদি ৭ দিনের মধ্যে কোনো Manufacturing defect বা সমস্যা দেখা দেয়,
                        তাহলে আপনি সম্পূর্ণ নতুন পণ্যের সাথে পরিবর্তন (Replacement) করতে পারবেন।
                    </p>

                    <hr>

                    <h5>২. প্রোডাক্ট অনুযায়ী ওয়ারেন্টি</h5>
                    <ul>
                        <li>কিছু প্রোডাক্টে ৬ মাস ওয়ারেন্টি</li>
                        <li>কিছু প্রোডাক্টে ১ বছর ওয়ারেন্টি</li>
                        <li>কিছু প্রোডাক্টে সর্বোচ্চ ২ বছর পর্যন্ত ওয়ারেন্টি</li>
                    </ul>

                    <p>
                        ওয়ারেন্টি সময়কাল প্রোডাক্ট অনুযায়ী পরিবর্তিত হতে পারে।
                    </p>

                    <hr>

                    <h5>৩. ওয়ারেন্টি ক্লেইম করার নিয়ম</h5>
                    <p>
                        ওয়ারেন্টি ক্লেইম করার জন্য আপনাকে অবশ্যই আমাদের সাথে যোগাযোগ করতে হবে:
                    </p>

                    <ul>
                        <li>📱 WhatsApp: 01886699757</li>
                        <li>📘 Facebook Page <a href="https://www.facebook.com/needoplus" target="_blank">Needoplus</a></li>
                    </ul>

                    <p>
                        আমাদের সাপোর্ট টিম আপনার সমস্যা যাচাই করে দ্রুত সমাধান দেবে।
                    </p>

                    <hr>

                    <h5>৪. ওয়ারেন্টি কী কী ক্ষেত্রে প্রযোজ্য</h5>
                    <ul>
                        <li>Manufacturing defect (কারখানাগত সমস্যা)</li>
                        <li>Motor বা Internal system সমস্যা</li>
                        <li>Normal ব্যবহারের মধ্যে অকার্যকর হয়ে যাওয়া</li>
                    </ul>

                    <hr>

                    <h5>৫. ওয়ারেন্টি যেসব ক্ষেত্রে প্রযোজ্য নয়</h5>
                    <ul>
                        <li>পণ্য ভেঙে গেলে (Physical Damage)</li>
                        <li>পানিতে পড়ে নষ্ট হলে</li>
                        <li>অযত্ন বা ভুল ব্যবহারের কারণে সমস্যা হলে</li>
                        <li>Electrical short circuit বা বাহ্যিক কারণে ক্ষতি হলে</li>
                        <li>Unauthorized repair বা খোলা হলে</li>
                    </ul>

                    <hr>

                    <h5>৬. গুরুত্বপূর্ণ শর্ত</h5>
                    <ul>
                        <li>ওয়ারেন্টি ক্লেইম করার সময় অর্ডার ইনফো দেখাতে হবে</li>
                        <li>Original প্যাকেজিং থাকলে অগ্রাধিকার দেওয়া হবে</li>
                        <li>সাপোর্ট টিমের সিদ্ধান্তই চূড়ান্ত বলে গণ্য হবে</li>
                    </ul>

                    <hr>

                    <h5>৭. যোগাযোগ</h5>
                    <p>
                        📱 WhatsApp: <strong>01886699757</strong><br>
                        📧 Email: <strong>needoplus757@gmail.com</strong>
                    </p>

                    <hr>

                    <p class="text-muted small">
                        NEEDO+ সর্বদা গ্রাহকের সন্তুষ্টিকে অগ্রাধিকার দেয় এবং দ্রুত সাপোর্ট নিশ্চিত করে।
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

@include('customer.partial.footer')