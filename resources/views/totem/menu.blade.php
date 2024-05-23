<div id="menu-page" class="fade-in">
    <div id="main-menu">
        <div id="menu-items-container">
            <div onclick="openGaleria()">
                <div class="icon-container">
                    <img
                        src="data:image/png;base64,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">
                </div>
                <div class='title'>
                    Galeria
                </div>
            </div>
            <div onclick="openVideos()">
                <div class="icon-container">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAABX0lEQVR4nO3YwW0CQRBE0To6DvJxTuREPKTBtX2As0WvgKqm/5PmNtJ6+EMbrQQAAAAAAAAAQIxi6chnQAB5Lw8BRIDV4+tl3AepoYsA+vIAuCOAGQHMCGBGADMCmMUFYL8IkHwh2tIOUMP3t6UdoIbvb0s7QA3f35Z2gBq+v+3tDxiOAGYEMCOAGQHMCGC2IsBF0kmZVgQoSTdJZ0k/yrImQD3WVdKvcqwLUI+VMpbWBqiQsbQ6QAWMJQLIO5YIIO9YIoC8Y4kAIoDtllXALyO+AeKfsO2WFT9DP6NCxk3nb5vzgCfwKiIowJWXcZ4At4Bxs3YEXULefK4NkIwAZgQwI4AZAcwIYBYXgP0iQPKFaEs7QA3f35Z2gBq+vy3tADV8f1vaAWr4/ra3P2A4ApgRwIwAZgQwI8DWACz9+xkQQN5LQgARYPWYehn3QWroIoC+JAAAAAAAAAAAADruDyVlF12rtm7zAAAAAElFTkSuQmCC">
                </div>
                <div class='title'>
                    Vídeo
                </div>
            </div>
            <div onclick="openCamera()">
                <div class="icon-container">
                    <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAADq0lEQVR4nO2by2oUQRSGfzOQBDO6SPbG2RhBiE8ghiy8LSXGjYgjKnmSJBIENWavhKDByzNEg8GFBOINdGMSjQudrUZdZKTIaRxlqvpWfZmq/4MDQ09PnZ7zd59TfboaIIQQQgghhBBCCCGEEEK8pwrgLYBmTvYewH7vo97CQo7BD0z5JACuFhD8wK50igK2/vD/HAHwvUABtgEchacC9OWc9031YB88FOBuCYIfmDqWUtAsgW1nlBayTHfWaJbA6siOyxQAxuDfR/bc4xWAtsH/kFMxVMX/HVMQ/gn+DwDDyI9h8ckagN0gqNycNxc6SQCyCwUoGApQMKUToBvAdQBfAGwBmJZtWVADMCFdzFUADQC/xRqybUH2OeiLANNt9p2yeDxdAMYBLAPYiVEU1b7PAJyTMZwVYKvNvmqbDUYtNeteAzjukwCfUx5DL4A5yzdK6oq4DaDHNQGm2uw7mcL/AIAXloPfas8B9LskQLeIsCVn/mSKIjwA4E2GwW9NSf2uCGCL3ohn/jqAWwBOABiSvk6ffD4p361HGGclYTpyVoC5CIG/GHFGo/a5BGAzZMzZBMfppACjIYFaBLA3wbjqyngUUphHfBegEjLVVDd5e1KMr347E1IPunwW4LzB5+OUwQ9QYzww+BnzWYBlQ85PknZM6UhXE576KkDN0F5QBdc2dUMtGPRRgAmNr4+W+zet9WZD4/OajwIsaHypuXxWzGp8zvsowKrGl7qhyorTGp8vfRSgofF1CNkxpPH51UcBfml8qXcFsqKq8fkz4u8pQErUSxkUQGAKKmkRPoXsOMMi/BdOQ0t6I7YuN022qRjaEeo1Ke+KcM3QilD9/LyWpqtjOOCjAJClI+38bUoDzeb085PG11KMcZwTYNzg84nFdvSiwc9ZnwXokociOr8zFh7I3DCMv+b7AxnIoinTqreHCdNRVa4i3bjK57GYYzopAGTRlM53UBPqEWdHFSm4upwf2E3Ex1kBemTRVDPENqSlrG7WDstZXpXPqtN5J8JqiKY8iUuyfslZASCLpUz1wJa94sIsswgrGQZ/2bWliVmlo9mYy9HDbEdyftp3F7wQIGDEUkpaSzDb0eGVAJA5+pgsHYn7gsaS3GQ5/YJGngzK6oV5eYbbkKdqyr7JtnlprEXt7cTFawHKAAUoGApQMBSgYChAwVAAXwWgwRgDCoBiTxIKAArgdZqyRtF/pNmhRgHgiACEEEIIIYQQQgghhBBCCCGEoCP5Ax8NZrxnxeB+AAAAAElFTkSuQmCC">
                </div>
                <div class='title'>
                    <p>Câmera</p>
                </div>
            </div>

        </div>


    </div>
    <div id="lentes-gride-container">
        <div id='lentes-grid-3' class="grid-3"></div>
    </div>
</div>