<?php

namespace maliklibs\Zkteco\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool connect()
 * @method static bool disconnect()
 * @method static bool|mixed version()
 * @method static bool|mixed osVersion()
 * @method static bool|mixed platform()
 * @method static bool|mixed fmVersion()
 * @method static bool|mixed workCode()
 * @method static bool|mixed ssr()
 * @method static bool|mixed pinWidth()
 * @method static bool|mixed faceFunctionOn()
 * @method static bool|mixed serialNumber()
 * @method static bool|mixed deviceName()
 * @method static bool|mixed disableDevice()
 * @method static bool|mixed enableDevice()
 * @method static array getUser()
 * @method static bool|mixed setUser(int $uid, int|string $userid, string $name, int|string $password, int $role = 0, int $cardno = 0)
 * @method static bool|mixed clearUsers()
 * @method static bool|mixed clearAdmin()
 * @method static bool|mixed removeUser(int $uid)
 * @method static array getFingerprint(int $uid)
 * @method static bool|mixed setFingerprint(int $uid, array $data)
 * @method static bool|mixed removeFingerprint(int $uid, array $data)
 * @method static array getAttendance()
 * @method static bool|mixed clearAttendance()
 * @method static bool|mixed setTime(string $t)
 * @method static bool|mixed getTime()
 * @method static bool|mixed shutdown()
 * @method static bool|mixed restart()
 * @method static bool|mixed sleep()
 * @method static bool|mixed resume()
 * @method static bool|mixed testVoice()
 * @method static bool|mixed clearLCD()
 * @method static bool|mixed writeLCD(int $rank, string $text)
 *
 * @see \maliklibs\Zkteco\Lib\ZKTeco
 */
class ZKTeco extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zkteco';
    }
} 