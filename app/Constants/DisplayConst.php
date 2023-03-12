<?php

namespace App\Constants;

class DisplayConst
{
    public final const SUCCESSFULL_CREATE_CLIENT_MESSAGE = "Новый клиент успешно добавлен";
    
    public final const SUCCESSFULL_CHANGE_CLIENT_STATUS_MESSAGE = "Статус клиента успешно изменен";
    
    public final const SUCCESSFULL_ADD_PAY_MESSAGE = "Новая оплата успешно добавлена";
    
    public final const SUCCESSFULL_CANCEL_PAY_MESSAGE = "Проведена отмена оплаты";
    
    public final const PAY_FROM_BLOCKED_CLIENT_ERROR = "Оплата от заблокированного пользователя невозможна";
    
    public final const CLIENT_IDENTIFICATION_DATA_ERROR = "Ошибка в идентификационных данных клиента";
    
    public final const REPORT_IDENTIFICATION_BOTH_FILTERS_ERROR = "Недопустимо одновременное применение фильтра и по id и по телефону клиента";
    
    public final const TYPICAL_PAY_ACTION = "Оплата";
    
    public final const CANCEL_PAY_ACTION = "Отмена";
}
