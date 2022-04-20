<?php

namespace kufeisoft;

class Ua {
  /**
   * 通过ua解析用户的操作系统及版本信息
   * @param String $useragent  用户ua串
   * @return Array ['server' => '', 'version' = > '']
   */
  public static function getOS(String $useragent):Array {
    $server = $version = '';
    if (preg_match('/Win/i', $useragent)) {
      $server = 'Windows';
      if (preg_match('/NT 10.0/i', $useragent) || preg_match('/NT 6.4/i', $useragent)) {
        $version = '10';
      } else if (preg_match('/NT 6.3/i', $useragent)) {
        $version = '8.1';
      } else if (preg_match('/NT 6.2/i', $useragent)) {
        $version = '8';
      } else if (preg_match('/NT 6.1/i', $useragent)) {
        $version = '7';
      } else if (preg_match('/NT 6.0/i', $useragent)) {
        $version = 'Vista';
      } else if (preg_match('/NT 5.2 x64/i', $useragent) || preg_match('/NT 5.1/i', $useragent) || preg_match('/Windows XP/i', $useragent)) {
        $version = 'XP';
      } else if (preg_match('/NT 5.2/i', $useragent)) {
        $version = 'Server 2003';
      } else if (preg_match('/NT 5.01/i', $useragent)) {
        $version = '2000 (SP1)';
      } else if (preg_match('/NT 5.0/i', $useragent) || preg_match('/Windows NT5/i', $useragent) || preg_match('/Windows 2000/i', $useragent)) {
        $version = '2000';
      } else if (preg_match('/NT 4.0/i', $useragent) || preg_match('/WinNT4.0/i', $useragent)) {
        $version = 'NT 4.0';
      } else if (preg_match('/NT 3.51/i', $useragent) || preg_match('/WinNT3.51/i', $useragent)) {
        $version = 'NT 3.11';
      } else if (preg_match('/NT/i', $useragent) || preg_match('/WinNT/i', $useragent)) {
        $version = 'NT';
      } else if (preg_match('/Windows 3.11/i', $useragent) || preg_match('/Win3.11/i', $useragent) || preg_match('/Win16/i', $useragent)) {
        $version = '3.11';
      } else if (preg_match('/Windows 3.1/i', $useragent)) {
        $version = '3.1';
      } else if (preg_match('/Windows 98; Win 9x 4.90/i', $useragent) || preg_match('/Win 9x 4.90/i', $useragent) || preg_match('/Windows ME/i', $useragent)) {
        $version = 'ME';
      } else if (preg_match('/Win98/i', $useragent)) {
        $version = '98 SE';
      } else if (preg_match('/Windows 98/i', $useragent) || preg_match('/Windows\ 4.10/i', $useragent)) {
        $version = '98';
      } else if (preg_match('/Windows 95/i', $useragent) || preg_match('/Win95/i', $useragent)) {
        $version = '95';
      } else if (preg_match('/Windows CE/i', $useragent)) {
        $version = 'CE';
      }
    } else if (preg_match('/Android/i', $useragent)) {
      $server = 'Android';
      if (preg_match('/Android[\ |\/]?([.0-9a-zA-Z]+)/i', $useragent, $regmatch))  $version = $regmatch[1];
    } else if (preg_match('/Mac/i', $useragent) || preg_match('/Darwin/i', $useragent)) {
      $server = 'Mac OS X';
      if (preg_match('/Mac OS X/i', $useragent) || preg_match('/Mac OSX/i', $useragent)) {
        // 因为IOS和MACOS都有相同UA串，所以瑞次判定下即可
        if (preg_match('/iPhone/i', $useragent) || preg_match('/iPad/i', $useragent)) {
          $server = 'iOS';
          if (preg_match('/iPhone/i', $useragent)) {
            // IPHONE
            $version = substr($useragent, strpos(strtolower($useragent), strtolower('iPhone OS')) + 10);
            $version = substr($version, 0, strpos($version, 'l') - 1);
          } else {
            // IPAD
            $version = substr($useragent, strpos(strtolower($useragent), strtolower('CPU OS')) + 7);
            $version = substr($version, 0, strpos($version, 'l') - 1);
          }
        } else if (preg_match('/Mac OS X/i', $useragent)) {
          $version = substr($useragent, strpos(strtolower($useragent), strtolower('OS X')) + 5);
          $version = substr($version, 0, strpos($version, ')'));
        } else {
          $version = substr($useragent, strpos(strtolower($useragent), strtolower('OSX')) + 4);
          $version = substr($version, 0, strpos($version, ')'));
        }
        if (strpos($version, ';') > -1) {
          $version = substr($version, 0, strpos($version, ';'));
        }
        $version = str_replace('_', '.', $version);
      } else if (preg_match('/Darwin/i', $useragent)) {
        $server = 'Mac OS Darwin';
      } else {
        $server = 'Macintosh';
      }
    } else if (preg_match('/[^A-Za-z]Arch/i', $useragent)) {
      $server = 'Arch Linux';
      $code = 'Arch-Linux';
    } else if (preg_match('/BlackBerry/i', $useragent)) {
      $server = 'BlackBerryOS';
    } else if (preg_match('/CentOS/i', $useragent)) {
      $server = 'CentOS';
      if (preg_match('/.el([.0-9a-zA-Z]+).centos/i', $useragent, $regmatch)) $version = $regmatch[1];
    } else if (preg_match('/CrOS/i', $useragent)) {
      $server = 'Google Chrome OS';
    } else if (preg_match('/Debian/i', $useragent)) {
      $title = 'Debian GNU/Linux';
    } else if (preg_match('/Fedora/i', $useragent)) {
      $title = 'Fedora';
      if (preg_match('/.fc([.0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
        $version = $regmatch[1];
      }
    } else if (preg_match('/FreeBSD/i', $useragent)) {
      $server = 'FreeBSD';
    } else if (preg_match('/OpenBSD/i', $useragent)) {
      $server = 'OpenBSD';
    } else if (preg_match('/Oracle/i', $useragent)) {
      $server = 'Oracle';
      if (preg_match('/.el([._0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
        $server .= ' Enterprise Linux';
        $version = str_replace('_', '.', $regmatch[1]);
      } else {
        $server .= ' Linux';
      }
    } else if (preg_match('/Red\ Hat/i', $useragent) || preg_match('/RedHat/i', $useragent)) {
      $server = 'Red Hat';
      if (preg_match('/.el([._0-9a-zA-Z]+)/i', $useragent, $regmatch)) {
        $server .= ' Enterprise Linux';
        $version = str_replace('_', '.', $regmatch[1]);
      }
    } else if (preg_match('/Solaris/i', $useragent) || preg_match('/SunOS/i', $useragent)) {
      $server = 'Solaris';
    } else if (preg_match('/Symb[ian]?[OS]?/i', $useragent)) {
      $server = 'SymbianOS';
      if (preg_match('/Symb[ian]?[OS]?\/([.0-9a-zA-Z]+)/i', $useragent, $regmatch))  $version = $regmatch[1];
    } else if (preg_match('/Ubuntu/i', $useragent)) {
      $server = 'Ubuntu';
      if (preg_match('/Ubuntu[\/|\ ]([.0-9]+[.0-9a-zA-Z]+)/i', $useragent, $regmatch)) $version = $regmatch[1];
    } else if (preg_match('/Linux/i', $useragent)) {
      $server = 'GNU/Linux';
    } else if (preg_match('/J2ME\/MIDP/i', $useragent)) {
      $server = 'J2ME/MIDP Device';
    } else {
      $server = 'Other System';
      $version = "Unknown Version";
    }
    if (preg_match('/x86_64/i', $useragent)) {
      $version = (is_null($version)) ? 'x64' : "$version x64";
    } else if ((preg_match('/Windows/i', $useragent) || preg_match('/WinNT/i', $useragent) || preg_match('/Win32/i', $useragent))  && (preg_match('/Win64/i', $useragent) || preg_match('/x64/i', $useragent) || preg_match('/WOW64/i', $useragent))) {
      $version .= ' x64 Edition';
    }
    return ['server' => $server, 'version' => $version];
  }
}