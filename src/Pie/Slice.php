<?php

namespace Maantje\Charts\Pie;

use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;
use Maantje\Charts\SVG\Text;

class Slice
{
    public function __construct(
        public float $value,
        public string $color,
        public string $label = '',
        public ?int $fontSize = null,
        public ?string $labelColor = null,
        public float $explodeDistance = 0.0,
    ) {}

    public function render(PieChart $chart, string $pathData, float $labelX, float $labelY, float $percentage, ?string $transform = null): string
    {
        $labelText = $chart->formatter->call($chart, $this->label, $percentage);

        return new Fragment([
            new Path(
                d: $pathData,
                fill: $this->color,
            ),
            ...Text::multiline(
                content: $labelText,
                x: $labelX,
                y: $labelY,
                fontFamily: $chart->fontFamily,
                fontSize: $this->fontSize ?? $chart->fontSize,
                fill: $this->labelColor ?? $chart->color,
                textAnchor: 'middle',
                dominantBaseline: 'middle',
                transform: $transform,
            ),
        ]);
    }
}
