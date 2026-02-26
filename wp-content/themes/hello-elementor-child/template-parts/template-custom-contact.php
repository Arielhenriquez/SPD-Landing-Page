<?php
/**
 * Template Name: Contact Us (Tailwind Integrated)
 */

// Inject assets specifically for this page's head
add_action('wp_head', function () {
?>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Dancing+Script:wght@700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#003060",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                        cursive: ["'Dancing Script'", "cursive"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        /* Scoped to this page's container to minimize leakage */
        .custom-contact-page-wrapper { font-family: 'Inter', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .hero-overlay {
            background: linear-gradient(to right, rgba(0, 48, 96, 0.92), rgba(0, 48, 96, 0.7));
        }
    </style>
    <?php
}, 5);

get_header();

?>

<!-- Wrapped in a div to apply Tailwind classes primarily to this scope -->
<main class="custom-contact-page-wrapper bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 transition-colors duration-300">

    <header class="relative min-h-[500px] w-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBOTH_XXiqo2Xmlvew0BGoutUjD_5zUP3JJIePy7kRKcWy_AIOwGaExeC1JdBU4ue6xw0R0TdIxV43s_fpgYikUGTBIY9QoJzaQUUL4jCPT5faFmnUPcxf_ddYcVZJp3RaTmIKF105ih4PMHQYq-H_zrdiZM4gmK91b_hBPJG688OPzmYKnFbQTZPWDseM1x8vFcNgBa00kqDrVWmorEPeZgBCP7ZvZmZosxI8XJe2sZt0G5vpqPq-e4zFe1xC56klPAajYkCDkkcVr');">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-32 pb-24">
            <div class="flex flex-col">
                <h1 class="!text-white text-7xl md:text-8xl font-bold tracking-tight">Contact</h1>
                <span class="font-cursive !text-white text-4xl md:text-5xl -mt-4 ml-32 md:ml-48">Us</span>
            </div>
        </div>
    </header>

    <section class="bg-white dark:bg-background-dark py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative">
            <div class="flex items-center gap-4">
                <button class="absolute left-2 z-10 p-2 rounded-full bg-white/80 dark:bg-slate-800/80 shadow-md text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <div class="flex gap-6 overflow-x-auto hide-scrollbar pb-4 px-4 w-full">
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Self-Perform" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5VRKrqGnAuE6qsIXJbtGwY2CIimBvDVUhXASnVdLTQ1uYLUjHaYIlNHflW45z016ks4U-0MQVJuspIUCxksSYX3uqfu092GxkPXfaHOIOeMpVmHzNzGJIVER8SRgXAet7VrD8yCeFkZ3LnoYyRzQr8XgDhXVJ90_ED7HZ1IW1fYo8970fnhwhlUnbBfmn82KqhMLHvhRvQXpANi9g5QgYJp1_Ij1ZhLdTp9Tmcil_FoPO4cW8_NizBUjz4c7ZeFi5izaVcC7HJpPn"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Self-Perform</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Preconstruction" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuARegXaS2KLac7l3kdUgk61C7OzzZlUFYLAtS-Npa8Ec_sSGQrG47KPoRawT3XRpDK61f7ymQOvGDdYb8yTHuKLoIAOJhhJpJUzOwATZJSYi3JivzGKU61zyJ7bX2xR6v__kKueLgnSXMK0TOGkMn78CTdZhSLSB30rpxA1fjshnx3ZgyE1YprOgYBSxsAS1dsQ5b0wN1BgfWqkkdAJDC2WpwX9MeXTw2gO7-Pgx2Crn6vpoXI0fi6yg-YMZlIXTlsjYi9Vfq36P_IH"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Preconstruction</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Construction Management" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJqdtYQ24hi0nIDE9jdPTC5w9W11B9AMsnX4OpAWejdPUkIqmH-9_6NoA8xAoEOmO3XN_j7Hm65_mWz6zwdP_t76WO4cz0HisTWMsNN_lRAbEU52zSAUFdkvSfI1F0F5jiNY5UovC6aF4haxnewXlXVyo-J7blxc39nFsHWiV2Zn8QWsCKMTbIMh611YM78qr3KBv9St7955o30eZ8Fl0j0G_tWCKBzinIyl7UGifHNP1TpDr1_iHBGsxtBqpYZ-s5pUQqn9xoykbh"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Construction Management</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Project Management" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPzr3wjLX0N7lP-1DBKpmj1pyyB57bRyQKCxkAdo49go2tjk40qpNMr9--NAo6Py62q71b4tJLTXi0NowqPeNkGUp3apgQNf8MX0w6wteqXCe3OxRLBrEiUeayega5g_CCiRxW7qcuQHAkC9qSHbZu-ZbUfmjsprVmGK2hxpeo8Mqc4A_kOrY1p7DEs34GAb1-1ZLNtfjmYktXfquNKL5j3aZa5rhO96pZU5Z2AZEmQ0N6qBjOiL_sdSVeL9-6wz-Zj-RK6v870kam"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Project Management</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Subcontracting" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMWI-aoVCV7_kwGhggjHLjRyoGNCYdfIdlTy1cSZc3yUYq0g044OMXvzXFSTFTWvu2VAQRviabM88s-Dl7TtTSo2LQtwGoM3eUPiC6pAvIFRahDM0gUNQUG1kk7FqTuNDmckYU-vvSVdJDY94LQzInnJAOw8Tp1cwW_typIeCNET4I3IPf5jGavKZRoMxoD3w2ZamOjel-_1yinxQANwU7j9Q6RbUa4hOiyla_PVN_0SHAr9qLHWla71N4B7hjermoiD5kaVDLTuwq"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Subcontracting</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Design-Build" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxboaxkwxDhUIWGDl6dCF1y5vh-wEXdDzA2DW9tCbaGuadITPQt-oMVnbh0L3ZhjSly0KtR0xfPEiCb8BDbHeOcX85wAd90e9tJ2QxUe7c4K6lYAjBCzLFLcSNpoSAUgkErNOBhVUu2udkGscSxv2sL4mQQc80iV0Hj-t4ksWLqQiwCN8UJUPIOAP25nVfaqKgeFdB8tBvX28fJEJYw_nqclks8OOaPCnKSAd2Lvck9KbRf1WTu-bJuo4N8SYXteW4mWDfxHF92vFA"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Design-Build</p>
                    </div>
                    <div class="flex-none w-44">
                        <div class="rounded-2xl overflow-hidden shadow-lg mb-3 aspect-square">
                            <img alt="Construction Manager at Risk" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBS9L5r8MjHGxfsMR241VV26qC8PVdetdWDFODs3epZYcs4ZBz662ekZPRlN5RU17wwCcR9MxDWsBXpF0xIabUMrQSaWbuYCQOoLWt4_DIMeA6pb8BDDvxtF3_frEL2Tbc6vHH8RlT43KfA-4jcicjlotcv_0Uv5lEjU5Z-cUyV92ZzP7U6CAQYT4yBAl_gxeocPl9nbKqTipbvo5bDui22CMZZvFKLokkgANg6P6KiWR0TXq4sPPOrEHtx1W1VdcrpSeaR_aDsfn7g"/>
                        </div>
                        <p class="text-center font-display font-medium text-sm text-slate-700 dark:text-slate-300">Construction Manager at Risk</p>
                    </div>
                </div>
                <button class="absolute right-2 z-10 p-2 rounded-full bg-white/80 dark:bg-slate-800/80 shadow-md text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </section>

    <section class="py-20 px-6 relative z-20">
        <div class="max-w-4xl mx-auto bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100 dark:border-slate-800">
            <div class="p-8 md:p-12">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-primary dark:text-blue-400 mb-4 tracking-tight">Contact Us</h2>
                    <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto">Get in touch with our team of experts for your next construction project.</p>
                </div>
                <form class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative">
                            <input class="w-full bg-transparent border-0 border-b-2 border-slate-200 dark:border-slate-700 focus:border-primary dark:focus:border-blue-500 focus:ring-0 px-0 py-3 transition-all peer placeholder-transparent !text-slate-900" id="first_name" placeholder="First Name" type="text"/>
                            <label class="absolute left-0 -top-3.5 !text-slate-600 dark:!text-slate-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:!text-slate-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:!text-primary dark:peer-focus:!text-blue-500 peer-focus:text-sm" for="first_name">First Name</label>
                        </div>
                        <div class="relative">
                            <input class="w-full bg-transparent border-0 border-b-2 border-slate-200 dark:border-slate-700 focus:border-primary dark:focus:border-blue-500 focus:ring-0 px-0 py-3 transition-all peer placeholder-transparent !text-slate-900" id="last_name" placeholder="Last Name" type="text"/>
                            <label class="absolute left-0 -top-3.5 !text-slate-600 dark:!text-slate-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:!text-slate-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:!text-primary dark:peer-focus:!text-blue-500 peer-focus:text-sm" for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative">
                            <input class="w-full bg-transparent border-0 border-b-2 border-slate-200 dark:border-slate-700 focus:border-primary dark:focus:border-blue-500 focus:ring-0 px-0 py-3 transition-all peer placeholder-transparent !text-slate-900" id="email" placeholder="E-mail Address" type="email"/>
                            <label class="absolute left-0 -top-3.5 !text-slate-600 dark:!text-slate-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:!text-slate-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:!text-primary dark:peer-focus:!text-blue-500 peer-focus:text-sm" for="email">E-mail Address</label>
                        </div>
                        <div class="relative">
                            <input class="w-full bg-transparent border-0 border-b-2 border-slate-200 dark:border-slate-700 focus:border-primary dark:focus:border-blue-500 focus:ring-0 px-0 py-3 transition-all peer placeholder-transparent !text-slate-900" id="phone" placeholder="Phone" type="tel"/>
                            <label class="absolute left-0 -top-3.5 !text-slate-600 dark:!text-slate-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:!text-slate-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:!text-primary dark:peer-focus:!text-blue-500 peer-focus:text-sm" for="phone">Phone</label>
                        </div>
                    </div>
                    <div class="relative">
                        <textarea class="w-full bg-transparent border-2 border-slate-200 dark:border-slate-700 rounded-xl focus:border-primary dark:focus:border-blue-500 focus:ring-0 p-4 transition-all placeholder-slate-400 dark:placeholder-slate-500" id="message" placeholder="Your message..." rows="4"></textarea>
                    </div>
                    <button class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-opacity-90 transition-all flex items-center justify-center gap-2 group shadow-lg shadow-primary/20" type="submit">
                        SEND <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>
                <div class="mt-16 pt-12 border-t border-slate-100 dark:border-slate-800 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
                    <div class="flex items-center gap-4 justify-center md:justify-start">
                        <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-500">
                            <span class="material-symbols-outlined text-lg">location_on</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400">1018 Bladensburg Rd NE<br/>Washington, DC 20002</p>
                    </div>
                    <div class="flex items-center gap-4 justify-center md:justify-start">
                        <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500">
                            <span class="material-symbols-outlined text-lg">phone</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400">202-934-5222</p>
                    </div>
                    <div class="flex items-center gap-4 justify-center md:justify-start">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-500">
                            <span class="material-symbols-outlined text-lg">email</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400">admin@spdcon-inc.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight">Related Projects</h2>
            <div class="flex gap-2">
                <button class="p-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined">west</span>
                </button>
                <button class="p-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <span class="material-symbols-outlined">east</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <article class="group">
                <div class="overflow-hidden rounded-3xl mb-6 shadow-xl aspect-video relative">
                    <img alt="The Wall at O Street SE" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhVOtn7H0edkswx54-FuoLO3jgri6O-hSRjb3nFS6W2qZcco_AOeuuAskf-K8OVLoB_U3-W4UC2sSrLU9ajo-eOl2eqxLem1HLazcZNgpNWvRDQlljN73qnLkPDfSGWnBOZWM5s6nkVa48Pemyj9XVMma9ymkcMO04-Rh7Kl0X2mLlo_OEAQvT2IOcUQGGasJ1316Z1lfDAeQVuJZovl1vxLmr_TmpTFfLIGRs7ScXK9xtvFmGc20mYAX3X7kqdfIt8u_fIt0RLr5K"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <h3 class="text-2xl font-bold mb-3 group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">The Wall at O Street SE</h3>
                <p class="text-slate-500 dark:text-slate-400 line-clamp-3 mb-4 leading-relaxed">
                    The Design-Build Services for the O Street SE Retaining Wall Restoration project involve the structural rehabilitation and stabilization of the existing retaining wall to ensure long-term integrity and compliance...
                </p>
                <a class="inline-flex items-center text-red-600 font-bold hover:gap-3 gap-2 transition-all" href="#">
                    Read more <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </article>
            <article class="group">
                <div class="overflow-hidden rounded-3xl mb-6 shadow-xl aspect-video relative">
                    <img alt="MPD 4th District HQ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2Sv_x5WCsnx03lhntAt8mjI6cO4_6Tna9_Lx56q34e95st2GpjzBBLCLXSAQIdnIa-V5QO0q5XvFkfBAkCf4Wj6gvxfpUS1ihWKjbZj4cKBCR5E_NhT-GlzL8dH6cNmb6grEi8QKzqxJ4kThWoYlvFToxrOUde1-P-RMixidpce703e7T7MrLKJUPQPw1EDygRL7LFoHBxIN1mfoEFivgA6E-4NHsMvQpvrucjvSKg89YXrWgkXDgeQAjuNTM99wXfpfug9F8tFY3"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <h3 class="text-2xl font-bold mb-3 group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">MPD 4th District HQ</h3>
                <p class="text-slate-500 dark:text-slate-400 line-clamp-3 mb-4 leading-relaxed">
                    SPD Contracting, Inc., as the Design-Builder, is overseeing the design and construction of the MPD 4th District Headquarters Generator Replacement Project...
                </p>
                <a class="inline-flex items-center text-red-600 font-bold hover:gap-3 gap-2 transition-all" href="#">
                    Read more <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </article>
        </div>
    </section>

</main>

<?php get_footer(); ?>