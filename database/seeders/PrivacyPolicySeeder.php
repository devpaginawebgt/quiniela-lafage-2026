<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivacyPolicy::create([
            'version' => '1.0.0',
            'content' => "# Política de Privacidad\nDesarrollado por: **Lafage S.A.**\n\n**Última actualización:** 10 de Abril de 2026\n\nLa presente Política de Privacidad describe cómo se recopila, utiliza y protege la información personal de los usuarios de la aplicación **«Lafage Quiniela 2026»** (en adelante, la «App»). Esta App está destinada únicamente a personas mayores de 18 años.\n## 1. Responsable del tratamiento\nEl responsable del tratamiento de los datos personales recopilados a través de la App es **Lafage S.A.**, quien determina los fines y medios del tratamiento de la información conforme a la normativa aplicable (en adelante, el «Responsable»).\n\nPara consultas relacionadas con privacidad, puede contactar a:\n- **Correo electrónico:** informacion@lab-lafage.com\n## 2. Datos personales que se recopilan\nPara crear y administrar la cuenta de acceso, se recopilan datos de identificación, contacto, ubicación y perfil profesional del usuario, así como las credenciales de acceso a la App.\n## 3. Datos que NO se recopilan\n- No se recopilan datos de ubicación.\n- No se recopilan datos financieros ni medios de pago.\n- No se utilizan sistemas de analítica o tracking.\n- No se muestran anuncios de terceros.\n## 4. Permisos de la aplicación\nLa App puede solicitar los siguientes permisos:\n- **Acceso a Internet:** requerido para la comunicación con los servidores propios.\n- **Notificaciones push:** para enviar avisos, comunicaciones o información relevante relacionada con el uso de la App.\n\nEl usuario puede activar o desactivar las notificaciones desde la configuración de su dispositivo iOS o Android.\n## 5. Finalidad del tratamiento\nLos datos personales se utilizan exclusivamente para:\n- Crear y administrar la cuenta del usuario.\n- Verificar la identidad del usuario.\n- Permitir el funcionamiento interno de la App.\n- Enviar notificaciones push si el usuario las tiene activadas.\n- Cumplir con obligaciones legales.\n## 6. Base legal\nEl tratamiento de los datos personales se fundamenta en:\n- **Consentimiento del usuario** al utilizar la App.\n- **Ejecución de una relación** necesaria para habilitar su cuenta y acceso.\n- **Interés legítimo** para garantizar la seguridad y funcionamiento de la App.\n## 7. Conservación de los datos\nLos datos se conservan mientras la cuenta esté activa o sea necesario para cumplir fines legales o administrativos.\n\nCuando el usuario solicite la eliminación de su cuenta, los datos serán eliminados o anonimizados, salvo obligación legal de conservarlos.\n## 8. Seguridad\nSe aplican medidas técnicas y organizativas razonables para proteger los datos personales. Las contraseñas se almacenan utilizando medidas adecuadas de seguridad como cifrado o hash.\n## 9. Cesión de datos\nNo se venden ni alquilan datos personales. Solo podrán compartirse con:\n- **Proveedores tecnológicos** que presten servicios técnicos necesarios para el funcionamiento de la App, bajo acuerdos de confidencialidad.\n- **Autoridades competentes** en caso de obligación legal.\n## 10. Edad mínima\nLa App está dirigida exclusivamente a **personas mayores de 18 años**. Si se detecta una cuenta asociada a un menor, será eliminada y sus datos serán suprimidos.\n## 11. Derechos del usuario\nEl usuario puede ejercer los siguientes derechos:\n- Acceso\n- Rectificación\n- Supresión\n- Limitación del tratamiento\n- Oposición\n- Portabilidad (cuando corresponda)\n\nPara ejercer estos derechos, puede contactar a:\n\n**Correo electrónico:** informacion@lab-lafage.com\n## 12. Cambios en esta Política\nEl Responsable podrá modificar esta Política para adaptarla a cambios legales o funcionales de la App. La versión vigente estará siempre disponible en esta misma página.\n## 13. Contacto\nPara cualquier duda o solicitud relacionada con esta Política de Privacidad:\n- **Correo electrónico:** informacion@lab-lafage.com\n\nEl uso de la App implica la aceptación de esta Política de Privacidad.",
            'is_active' => true,
        ]);
    }
}
