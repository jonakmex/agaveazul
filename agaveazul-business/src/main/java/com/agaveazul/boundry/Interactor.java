package com.agaveazul.boundry;

import com.agaveazul.boundry.port.callback.CallBack;
import com.agaveazul.boundry.port.input.InputPort;

public interface Interactor<I extends InputPort,C extends CallBack> {
    void execute(I inputPort,C callback);
}
