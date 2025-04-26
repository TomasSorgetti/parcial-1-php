
<main>
    <!-- Hero -->
    <section>
        <div class="flex justify-between items-center max-w-[1280px] mx-auto py-20">
            <div class="flex flex-col gap-8">
                <h1 class="text-5xl font-bold uppercase">Armá la Máquina que la Rompe en el Silicio</h1>
                <p class="text-base max-w-[600px]">En Code Crafters, armás tu equipo con procesadores potentes, GPUs de vanguardia y placas madre sólidas. Personalizá tu PC en un estilo negro y violeta. ¡Hacelo realidad!</p>
                <div class="flex gap-4">
                    <a href="#" class="inline-flex items-center justify-center uppercase min-w-[200px] font-bold text-lg bg-transparent border-2 border-white h-[58px] px-6 rounded-full">productos</a>
                    <a href="#" class="inline-flex items-center justify-center uppercase min-w-[200px] font-bold text-lg bg-[var(--primary-color)] border-2 border-[var(--primary-color)] h-[58px] px-6 rounded-full">arma tu pc</a>
                </div>
            </div>
            <img src="src/assets/images/home_banner.webp" alt="ilustración minimalista con cuadriculas">
        </div>
    </section>

    <!-- Categories -->
    <section class="relative">
        <img src="src/assets/images/home_categories.webp" alt="luz violeta en fondo negro" class="absolute top-0 left-0 w-full -z-10">
        <div class="text-center flex flex-col gap-8 items-center pt-90">
            <h2 class="text-4xl font-bold uppercase max-w-[640px]">Encontrá el Componente Perfecto</h2>
            <p class="max-w-[600px] text-[var(--dark-text-color)] text-base">Explorá las distintas categorías que tenemos para vos y armá una PC que supere todos los límites. Calidad, rendimiento y estilo en cada componente.</p>
        </div>
        <div class="relative grid grid-cols-5 gap-4 max-w-[800px] mx-auto py-20 grid-rows-2 h-[600px]">
            <?php 
                $categoriesData = json_decode(file_get_contents('src/data/categories.json'), true);

                echo('
                    <a href="index.php?page=products&category=' . $categoriesData[0]['path'] . '" class="col-span-2 row-span-2 bg-black rounded-[20px] py-8 border-1 border-[var(--light-dark-color)] flex flex-col justify-between">
                        <h3 class="text-2xl font-bold uppercase text-white pl-8">' . $categoriesData[0]['name'] . '</h3>
                        <img src="src/assets/images/categories/' . $categoriesData[0]['path'] . '.png" alt="' . $categoriesData[0]['name'] . '" class="w-full mt-10"/>
                    </a>'
                );
                echo('
                    <a href="index.php?page=products&category=' . $categoriesData[1]['path'] . '" class="col-span-3 row-span-1 bg-black rounded-[20px] p-4 border-1 border-[var(--light-dark-color)] ">
                        <h3 class="text-2xl font-bold uppercase text-white">' . $categoriesData[1]['name'] . '</h3>
                        <img src="src/assets/images/categories/' . $categoriesData[1]['path'] . '.png" alt="' . $categoriesData[0]['name'] . '"/>

                    </a>'
                );
                echo('
                    <a href="index.php?page=products&category=' . $categoriesData[2]['path'] . '" class="col-span-3 row-span-1 bg-black rounded-[20px] p-4 border-1 border-[var(--light-dark-color)] ">
                        <h3 class="text-2xl font-bold uppercase text-white">' . $categoriesData[2]['name'] . '</h3>
                        <img src="src/assets/images/categories/' . $categoriesData[2]['path'] . '.png" alt="' . $categoriesData[0]['name'] . '"/>
                    </a>'
                );
            ?>

<div class="absolute -z-10 block w-[700px] h-[300px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-full" style="background:rgba(137, 3, 255, 0.23); backdrop-filter: blur(300px); box-shadow: 0 0 100px rgba(137, 3, 255, 0.5);"></div>
        </div>
    </section>

    <!-- Cta -->
     <section class="relative flex items-center justify-center min-h-[874px]">
        <img src="src/assets/images/home_cta.webp" alt="fondo cuadriculado decorativo" class="w-full absolute max-w-[1440px] -z-10">
        <div class="text-center flex flex-col gap-8 items-center pt-30">
            <h2 class="text-4xl font-bold uppercase max-w-[640px]">Descubrí qué te ofrece Code Crafters</h2>
            <p class="max-w-[600px] text-[var(--dark-text-color)] text-base">Armá tu PC con la mejor calidad y rendimiento. En Code Crafters, te ofrecemos una amplia gama de componentes para construir tu PC perfecta.</p>
            <div class="flex gap-4">
                    <a href="#" class="inline-flex items-center justify-center uppercase min-w-[200px] font-bold text-lg bg-transparent border-2 border-white h-[58px] px-6 rounded-full">productos</a>
                    <a href="#" class="inline-flex items-center justify-center uppercase min-w-[200px] font-bold text-lg bg-[var(--primary-color)] border-2 border-[var(--primary-color)] h-[58px] px-6 rounded-full">arma tu pc</a>
                </div>
        </div>
     </section>

    <!-- Community -->
    <section class="bg-[url(src/assets/images/home_community_bg.webp)] bg-cover bg-center flex flex-col items-center justify-center min-h-[900px] text-center gap-12 mt-40">
        <h2 class="text-4xl font-bold uppercase max-w-[640px]">Dream Big with Bespoke Software Solutions</h2>
        <p class="max-w-[600px] text-[var(--dark-text-color)] text-base">From startups to dreamers, we blend user-centered design with bespoke software development to bring your ideas to life, scalable, affordable, and uniquely yours.</p>
        
        <!-- Social Icons -->
        <div class="flex gap-8">
            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="37" viewBox="0 0 38 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7328 19.9714H22.7732L23.5893 16.666H20.7328V15.0132C20.7328 14.1621 20.7328 13.3605 22.3651 13.3605H23.5893V10.584C23.3233 10.5484 22.3186 10.4683 21.2576 10.4683C19.0417 10.4683 17.4681 11.8375 17.4681 14.3522V16.666H15.0197V19.9714H17.4681V26.9955H20.7328V19.9714Z" fill="white" class="group-hover:fill-[var(--primary-color)]"/>
                    <circle cx="19.3042" cy="18.5" r="18" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.9463 16.173C18.2882 16.173 17.657 16.4344 17.1916 16.8998C16.7263 17.3652 16.4648 17.9964 16.4648 18.6545C16.4648 19.3126 16.7263 19.9438 17.1916 20.4092C17.657 20.8746 18.2882 21.136 18.9463 21.136C19.6045 21.136 20.2356 20.8746 20.701 20.4092C21.1664 19.9438 21.4278 19.3126 21.4278 18.6545C21.4278 17.9964 21.1664 17.3652 20.701 16.8998C20.2356 16.4344 19.6045 16.173 18.9463 16.173ZM18.9463 14.5187C20.0432 14.5187 21.0952 14.9544 21.8708 15.73C22.6464 16.5056 23.0822 17.5576 23.0822 18.6545C23.0822 19.7514 22.6464 20.8034 21.8708 21.579C21.0952 22.3546 20.0432 22.7903 18.9463 22.7903C17.8494 22.7903 16.7975 22.3546 16.0219 21.579C15.2462 20.8034 14.8105 19.7514 14.8105 18.6545C14.8105 17.5576 15.2462 16.5056 16.0219 15.73C16.7975 14.9544 17.8494 14.5187 18.9463 14.5187ZM24.3229 14.3119C24.3229 14.5861 24.214 14.8491 24.0201 15.043C23.8262 15.2369 23.5632 15.3458 23.289 15.3458C23.0147 15.3458 22.7517 15.2369 22.5578 15.043C22.3639 14.8491 22.255 14.5861 22.255 14.3119C22.255 14.0376 22.3639 13.7746 22.5578 13.5807C22.7517 13.3868 23.0147 13.2779 23.289 13.2779C23.5632 13.2779 23.8262 13.3868 24.0201 13.5807C24.214 13.7746 24.3229 14.0376 24.3229 14.3119ZM18.9463 12.0371C16.8999 12.0371 16.5657 12.0429 15.6137 12.0851C14.9652 12.1157 14.5301 12.2026 14.1264 12.3597C13.7888 12.4841 13.4835 12.6829 13.2331 12.9412C12.9744 13.1916 12.7754 13.4969 12.6508 13.8346C12.4936 14.2399 12.4067 14.6742 12.377 15.3218C12.334 16.235 12.3282 16.5543 12.3282 18.6545C12.3282 20.7017 12.334 21.0351 12.3761 21.9871C12.4067 22.6348 12.4936 23.0707 12.6499 23.4736C12.7906 23.8334 12.956 24.0923 13.2306 24.3669C13.5094 24.6448 13.7683 24.8111 14.1239 24.9484C14.5326 25.1064 14.9677 25.1941 15.6128 25.2239C16.526 25.2669 16.8453 25.2718 18.9455 25.2718C20.9927 25.2718 21.3261 25.266 22.2782 25.2239C22.925 25.1933 23.3601 25.1064 23.7646 24.9501C24.1022 24.8257 24.4075 24.6269 24.6579 24.3686C24.9367 24.0906 25.1029 23.8317 25.2403 23.4752C25.3974 23.0683 25.4851 22.6332 25.5149 21.9863C25.5579 21.074 25.5628 20.7538 25.5628 18.6545C25.5628 16.6081 25.5571 16.2739 25.5149 15.3218C25.4843 14.675 25.3966 14.2382 25.2403 13.8346C25.1159 13.497 24.9171 13.1916 24.6588 12.9412C24.4084 12.6826 24.1031 12.4835 23.7654 12.3589C23.3601 12.2018 22.925 12.1149 22.2782 12.0851C21.3658 12.0421 21.0465 12.0371 18.9455 12.0371M18.9455 10.3828C21.1929 10.3828 21.4733 10.3911 22.3559 10.4324C23.236 10.4738 23.8365 10.6119 24.3635 10.8171C24.9094 11.0272 25.3693 11.3117 25.8292 11.7708C26.25 12.1842 26.5755 12.6844 26.7829 13.2365C26.9872 13.7634 27.1262 14.364 27.1676 15.2449C27.2064 16.1267 27.2172 16.4071 27.2172 18.6545C27.2172 20.9019 27.2089 21.1823 27.1676 22.0641C27.1262 22.9458 26.9872 23.5447 26.7829 24.0724C26.5755 24.6246 26.25 25.1248 25.8292 25.5382C25.4158 25.959 24.9156 26.2844 24.3635 26.4919C23.8365 26.6962 23.236 26.8352 22.3559 26.8765C21.4733 26.9154 21.1929 26.9262 18.9455 26.9262C16.6981 26.9262 16.4177 26.9179 15.5351 26.8765C14.655 26.8352 14.0553 26.6962 13.5276 26.4919C12.9754 26.2844 12.4752 25.959 12.0618 25.5382C11.641 25.1248 11.3156 24.6246 11.1081 24.0724C10.903 23.5455 10.7648 22.945 10.7235 22.0641C10.6838 21.1823 10.6738 20.9019 10.6738 18.6545C10.6738 16.4071 10.6821 16.1267 10.7235 15.2449C10.7648 14.3631 10.903 13.7643 11.1081 13.2365C11.3156 12.6844 11.641 12.1842 12.0618 11.7708C12.4752 11.35 12.9754 11.0245 13.5276 10.8171C14.0545 10.6119 14.6542 10.4738 15.5351 10.4324C16.4185 10.3936 16.6989 10.3828 18.9463 10.3828" fill="#D9D9D9" class="group-hover:fill-[var(--primary-color)]"/>
                    <circle cx="18.9458" cy="19.3042" r="18.0181" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.439 18.1778L26.1411 11.9512H24.7896L19.8398 17.3574L15.8845 11.9512H11.3232L17.3036 20.1273L11.3232 26.6564H12.6747L17.9027 20.9466L22.0799 26.6564H26.6412L20.439 18.1778ZM18.5886 20.1987L17.9827 19.3847L13.1613 12.907H15.2369L19.1269 18.1347L19.7328 18.9487L24.7908 25.7447H22.7151L18.5886 20.1987Z" fill="#D9D9D9" class="group-hover:fill-[var(--primary-color)]"/>
                    <circle cx="18.9819" cy="19.3042" r="18.0181" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.9147 9.37891C21.1662 9.37891 21.4074 9.47881 21.5852 9.65663C21.763 9.83445 21.8629 10.0756 21.8629 10.3271C21.8635 11.2013 22.1657 12.0485 22.7185 12.7257C23.2713 13.4029 24.0408 13.8686 24.8972 14.0441C25.1437 14.0944 25.36 14.2405 25.4987 14.4504C25.6374 14.6602 25.6871 14.9165 25.6368 15.163C25.5865 15.4094 25.4404 15.6258 25.2305 15.7645C25.0207 15.9032 24.7644 15.9529 24.5179 15.9026C23.5301 15.9001 22.6138 15.2387 21.8629 14.5656V22.6538C21.8629 23.5915 21.5849 24.5081 21.0639 25.2878C20.543 26.0675 19.8025 26.6751 18.9362 27.034C18.0699 27.3928 17.1166 27.4867 16.197 27.3038C15.2773 27.1208 14.4325 26.6693 13.7695 26.0062C13.1064 25.3432 12.6549 24.4984 12.472 23.5788C12.289 22.6591 12.3829 21.7058 12.7418 20.8395C13.1006 19.9732 13.7083 19.2327 14.4879 18.7118C15.2676 18.1908 16.1842 17.9128 17.1219 17.9128C17.3734 17.9128 17.6146 18.0127 17.7924 18.1905C17.9702 18.3683 18.0701 18.6095 18.0701 18.861C18.0701 19.1125 17.9702 19.3536 17.7924 19.5315C17.6146 19.7093 17.3734 19.8092 17.1219 19.8092C16.5593 19.8092 16.0093 19.976 15.5415 20.2886C15.0737 20.6012 14.7091 21.0454 14.4938 21.5652C14.2785 22.085 14.2222 22.657 14.3319 23.2088C14.4417 23.7606 14.7126 24.2674 15.1104 24.6653C15.5083 25.0631 16.0151 25.334 16.5669 25.4438C17.1187 25.5535 17.6907 25.4972 18.2105 25.2819C18.7303 25.0666 19.1746 24.702 19.4871 24.2342C19.7997 23.7664 19.9665 23.2164 19.9665 22.6538V10.3271C19.9665 10.0756 20.0664 9.83445 20.2443 9.65663C20.4221 9.47881 20.6633 9.37891 20.9147 9.37891Z" fill="#D9D9D9" class="group-hover:fill-[var(--primary-color)]"/>
                    <circle cx="19.0181" cy="19.3042" r="18.0181" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.9635 18.6544L17.624 20.5627V16.7461L20.9635 18.6544Z" fill="#D9D9D9" stroke="#D9D9D9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-[var(--primary-color)]"/>
                    <path d="M9.5127 19.3299V17.9788C9.5127 15.2165 9.5127 13.8349 10.3762 12.9466C11.2407 12.0574 12.6013 12.0192 15.3216 11.9419C16.6097 11.9056 17.9264 11.8799 19.0542 11.8799C20.182 11.8799 21.4978 11.9056 22.7868 11.9419C25.5071 12.0192 26.8677 12.0574 27.7312 12.9466C28.5947 13.8359 28.5957 15.2175 28.5957 17.9788V19.3289C28.5957 22.0921 28.5957 23.4728 27.7322 24.3621C26.8677 25.2504 25.508 25.2895 22.7868 25.3658C21.4987 25.403 20.182 25.4288 19.0542 25.4288C17.9264 25.4288 16.6106 25.403 15.3216 25.3658C12.6013 25.2895 11.2407 25.2513 10.3762 24.3621C9.51174 23.4728 9.5127 22.0912 9.5127 19.3299Z" stroke="#D9D9D9" stroke-width="1.5" class="group-hover:stroke-[var(--primary-color)]"/>
                    <circle cx="19.0542" cy="19.3042" r="18.0181" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>

            <a href="#" class="inline-flex items-center justify-center group hover:scale-115 duration-300" target="_blank">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0268 21.1274C13.0632 21.1384 13.1004 21.1469 13.1381 21.153C13.3767 21.7044 13.6139 22.2563 13.8499 22.8088C14.2741 23.8029 14.7016 24.8268 14.7952 25.1213C14.9125 25.4835 15.0356 25.73 15.1705 25.8987C15.2405 25.9847 15.3206 26.0608 15.4151 26.1187C15.4647 26.1482 15.5173 26.1726 15.572 26.1915C15.8418 26.2907 16.0881 26.2494 16.2424 26.1989C16.333 26.1687 16.4192 26.127 16.4988 26.0749L16.503 26.0732L18.8863 24.6159L21.6398 26.6853C21.6802 26.7156 21.7241 26.7412 21.7713 26.7622C22.1019 26.9028 22.4224 26.9524 22.7243 26.9127C23.0245 26.8713 23.2632 26.7481 23.4411 26.6083C23.6453 26.4467 23.8081 26.2405 23.9168 26.0062L23.9244 25.988L23.9269 25.9814L23.9286 25.9781V25.9765L23.9294 25.9756C23.9433 25.9398 23.9545 25.903 23.9632 25.8656L26.4763 13.439C26.4832 13.3991 26.4872 13.3587 26.4881 13.3182C26.4881 12.9543 26.3481 12.6078 26.0201 12.3985C25.7384 12.2191 25.4255 12.2108 25.2273 12.2257C25.0148 12.2422 24.8175 12.2935 24.685 12.3348C24.6111 12.3583 24.5379 12.3842 24.4658 12.4126L24.4565 12.4167L10.361 17.839L10.3593 17.8398C10.3115 17.8567 10.2645 17.8758 10.2185 17.8969C10.1066 17.9461 9.99941 18.0047 9.89798 18.0722C9.70655 18.2004 9.26548 18.5527 9.34054 19.135C9.39957 19.5981 9.72341 19.8835 9.9216 20.0208C10.0295 20.096 10.1324 20.1498 10.2083 20.1853C10.2421 20.2019 10.3146 20.23 10.3458 20.2432L10.3542 20.2457L13.0268 21.1274ZM24.9499 13.5581H24.9482L24.9262 13.5672L10.8138 18.9969L10.7919 19.0051L10.7835 19.0076C10.7576 19.0174 10.7323 19.0284 10.7076 19.0407C10.7312 19.0537 10.7554 19.0655 10.7801 19.0763L13.4299 19.9513C13.4767 19.9683 13.5218 19.9893 13.5648 20.0141L22.3161 14.9897L22.3246 14.9856C22.3587 14.9656 22.3936 14.9469 22.4291 14.9293C22.4898 14.8987 22.5868 14.8541 22.6965 14.821C22.7724 14.7978 22.9975 14.7325 23.2404 14.8094C23.3694 14.8489 23.4845 14.9233 23.5722 15.0242C23.6599 15.125 23.7168 15.2481 23.7363 15.3793C23.7677 15.494 23.7686 15.6148 23.7388 15.7299C23.6798 15.9574 23.5179 16.1344 23.3703 16.27C23.2438 16.3858 21.6027 17.9374 19.9843 19.4691L17.7807 21.5533L17.3885 21.9255L22.3406 25.6489C22.4074 25.6763 22.48 25.6877 22.5523 25.682C22.5886 25.6771 22.6228 25.6622 22.6509 25.639C22.6851 25.6107 22.7144 25.5772 22.7378 25.5398L22.7395 25.5389L25.1767 13.4861C25.1001 13.5046 25.0248 13.5284 24.9515 13.5572L24.9499 13.5581ZM17.8144 23.8087L16.826 23.066L16.5865 24.5589L17.8144 23.8087ZM15.9194 21.5922L16.9019 20.6617L19.1055 18.5759L19.9261 17.8001L14.4275 20.957L14.4571 21.0248C14.8038 21.8283 15.1468 22.6333 15.4859 23.4398L15.7246 21.9511C15.7464 21.8131 15.815 21.6872 15.9194 21.5922Z" fill="#D9D9D9" class="group-hover:fill-[var(--primary-color)]"/>
                    <circle cx="19.0903" cy="19.3042" r="18.0181" stroke="white" class="group-hover:stroke-[var(--primary-color)]"/>
                </svg>
            </a>
        </div>
    </section>
</main>

