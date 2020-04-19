package com.agaveazul.interactor;

import com.agaveazul.boundry.callback.SaveUnitCallback;
import com.agaveazul.boundry.interactor.SaveUnitInteractor;
import com.agaveazul.boundry.port.input.SaveUnitInputPort;
import com.agaveazul.boundry.port.input.exception.InputNotValidException;
import com.agaveazul.boundry.port.output.SaveUnitOutputPort;
import com.agaveazul.entitiy.Unit;
import com.agaveazul.gateway.UnitGateway;
import lombok.Setter;

public class SaveUnitInteractorImpl implements SaveUnitInteractor {
    @Setter
    private UnitGateway unitGateway;

    @Override
    public void execute(SaveUnitInputPort inputPort, SaveUnitCallback callback){
        SaveUnitOutputPort outputPort = new SaveUnitOutputPort();
        try {
            inputPort.validate();
            Unit unit = new Unit();
            unit.setId(inputPort.id);
            unit.setDescription(inputPort.description);
            Unit savedUnit = unitGateway.save(unit);
            outputPort.success = true;
            outputPort.savedUnit = savedUnit;
        } catch (InputNotValidException e) {
            outputPort.messages = e.messages;
            outputPort.success = false;
        }
        callback.execute(outputPort);
    }
}
