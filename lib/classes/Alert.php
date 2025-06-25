<?php

class Alert
{
    public static function add(string $type, string $msg)
    {
        if (!isset($_SESSION['alerts'])) {
            $_SESSION['alerts'] = [];
        }
        $_SESSION['alerts'][] = [
            'type' => $type,
            'msg' => $msg,
        ];
    }

    public static function clear()
    {
        unset($_SESSION['alerts']);
    }

    public static function get()
    {
        if (!empty($_SESSION['alerts'])) {
            $actualAlerts = "";
            foreach ($_SESSION['alerts'] as $index => $alert) {
                $actualAlerts .= self::print($alert, $index);
            }
            // Script para cierre secuencial
            $actualAlerts .= "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const alerts = document.querySelectorAll('.alert');
                        alerts.forEach((alert, index) => {
                            setTimeout(() => {
                                alert.style.opacity = '0';
                                setTimeout(() => {
                                    alert.style.display = 'none';
                                }, 500);
                            }, 3000 * (index + 1)); // 3s por alerta, secuencial
                        });
                    });
                </script>
            ";

            self::clear();
            return $actualAlerts;
        }
        return "";
    }

    public static function print($alert, $index)
    {
        $typeClasses = [
            'danger' => 'bg-red-100 border-red-500 text-red-700',
            'success' => 'bg-green-100 border-green-500 text-green-700',
            'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
            'info' => 'bg-blue-100 border-blue-500 text-blue-700',
        ];

        $class = $typeClasses[$alert['type']] ?? 'bg-gray-100 border-gray-500 text-gray-700';

        // Agregar ID único y transición para animación
        return "<div id='alert-$index' class='alert w-full flex items-center justify-between border-l-4 p-4 rounded-md shadow-md $class mb-2 transition-opacity duration-500' role='alert' aria-live='assertive'>" .
            "<p>" . htmlspecialchars($alert['msg']) . "</p>" .
            "<button type='button' class='close ml-4 text-3xl cursor-pointer text-gray-700 hover:text-gray-900' onclick='this.parentElement.style.opacity=\"0\"; setTimeout(() => this.parentElement.style.display=\"none\", 500)'>×</button>" .
            "</div>";
    }
}
