Magento - PageCache Bypass
==========================
![Magento version](https://img.shields.io/badge/Magento-&gt;=%202.3.x-orange?style=for-the-badge)
![MIT License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)
![Made by Emakina](https://img.shields.io/badge/Made%20by-EMAKINA-black?style=for-the-badge)

A lightweight module to allow bypassing the built-in page cache with an HTTP parameter.  
This is especially useful if you want to do some profiling with [Blackfire](https://blackfire.io/) where you can't
afford to disable the page cache.

📦 Installation
---------------
```bash
composer require emakinafr/magento2-pagecache-bypass
bin/magento setup:upgrade
```

⚙ Configuration
----------------
The name of the HTTP parameter used to bypass the built-in page cache can be configured in back-office through:  
**Stores** > **Configuration** > **Advanced** > **Developer** > **PageCache Bypass by Emakina**.

🚀 Usage
--------
This module does not change the default behavior if you do not pass the bypass parameter.

```bash
# The Magento built-in page cache is still used.
https://magento2.localhost/

# The Magento built-in page cache is bypassed.
https://magento2.localhost/?pagecache_bypass
```

🤝 Contributing
---------------
Contributions, issues and feature requests are welcome!  
By the way, don't forget you can give a ⭐️ if this project helped you!

📝 License
----------
Copyright © [Emakina](https://www.emakina.fr/). This project is licensed under the [MIT](/LICENSE) license.
